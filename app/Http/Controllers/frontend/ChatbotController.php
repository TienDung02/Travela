<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\GeminiService;
use App\Models\Package;
use App\Models\Tour;
use App\Models\Place;
use App\Models\Hotel;
use Illuminate\Support\Str;

class ChatbotController
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function sendMessage(Request $request)
    {
        $userMessage = $request->input('message');

        // 1. Extract province/district entities from user input
        $matchedLocations = $this->findPlacesInMessage($userMessage);

        // 2. Retrieve related hotels, tours, packages
        $hotels = collect();
        $tours = collect();
        $packages = collect();
        $places = collect();
        if ($matchedLocations->isNotEmpty()) {
            $locationNames = $matchedLocations->pluck('name')->unique();

            // Hotels with matching partial name or partial address
            $hotels = \App\Models\Hotel::where(function($q) use ($locationNames) {
                foreach ($locationNames as $name) {
                    $q->orWhere('address', 'like', "%{$name}%")
                      ->orWhere('name', 'like', "%{$name}%");
                }
            })->get()->take(5);

            // Places with matching partial name or partial address
            $places = \App\Models\Place::where(function($q) use ($locationNames) {
                foreach ($locationNames as $name) {
                    $q->orWhere('name', 'like', "%{$name}%")
                      ->orWhere('address', 'like', "%{$name}%");
                }
            })->get()->take(5);

            // Tours that have places with partial name or partial address match
            $tours = \App\Models\Tour::whereHas('places', function($q) use ($locationNames) {
                foreach ($locationNames as $name) {
                    $q->orWhere('places.name', 'like', "%{$name}%")
                      ->orWhere('places.address', 'like', "%{$name}%");
                }
            })->with('places')->get()->take(5);

            // Packages whose tour has places with partial name or partial address match
            $packages = \App\Models\Package::whereHas('tour.places', function($q) use ($locationNames) {
                foreach ($locationNames as $name) {
                    $q->orWhere('places.name', 'like', "%{$name}%")
                      ->orWhere('places.address', 'like', "%{$name}%");
                }
            })->with('tour.places')->get()->take(5);
        } else {
            $places = collect();
        }

        // 3. Build context from retrieved data
        $context = $this->buildContextFromRetrieved($hotels, $tours, $packages, $places);
        Log::info("🟦 Context từ dữ liệu đã lấy:\n" . $context);
        // 4. Add fallback context if nothing found
        if (empty($context)) {
            $context = $this->buildContextFromDatabase();
        }

        // 5. Compose prompt
        $prompt = <<<EOT
Bạn là trợ lý AI của hệ thống Travela.

Dưới đây là một số dữ liệu liên quan đến địa chỉ mà người dùng vừa hỏi:

$context

Hãy trả lời câu hỏi của người dùng một cách tự nhiên, thân thiện và dễ hiểu nhất có thể. Nếu có các gợi ý liên quan, hãy liệt kê chúng kèm theo link. Mỗi link hãy trình bày dưới dạng thẻ <a> với thuộc tính title là nội dung gợi ý và href là đường dẫn tương ứng. Nếu không có thông tin nào phù hợp, hãy trả lời rằng không tìm thấy thông tin liên quan. Trả lời bằng tiếng Việt.


Câu hỏi người dùng: $userMessage
EOT;

        // Ghi log prompt
        Log::info("🟦 Prompt gửi Gemini:\n" . $prompt);

        try {
            // Gọi Gemini
            $reply = $this->geminiService->chatBot(['message' => $prompt]);
            
            // Xử lý phản hồi để biến đổi URLs thành links có thể click được
            $processedReply = $reply;

            // Ghi log phản hồi
            Log::info("🟩 Phản hồi từ Gemini:\n" . $reply);
            Log::info("🟩 Phản hồi đã xử lý:\n" . $processedReply);

            return response()->json([
                'reply' => $processedReply
            ]);
        } catch (\Throwable $e) {
            // Ghi log lỗi
            Log::error("🟥 Lỗi gọi Gemini API: " . $e->getMessage());

            return response()->json([
                'reply' => "Xin lỗi, đã xảy ra lỗi khi liên hệ với trợ lý AI."
            ]);
        }
    }

    /**
     * Xử lý phản hồi từ Gemini để chuyển URLs thành links có thể click được
     * và định dạng markdown thành HTML
     */
    private function processReplyForLinks($reply)
    {
        // Chuyển đổi định dạng markdown bold (**text**) thành <strong> trước khi xử lý URL
        $reply = preg_replace('/\*\*(.*?)\*\*/m', '<strong>$1</strong>', $reply);
        
        // Tìm tất cả URLs và lưu lại để xử lý
        preg_match_all('/(https?:\/\/[^\s"<>]+)|(localhost:[0-9]+\/[^\s"<>]+)/i', $reply, $matches);
        $allUrls = array_merge($matches[0], $matches[1], $matches[2]);
        $allUrls = array_filter($allUrls);
        
        // Tạo mảng lưu trữ các URL và tên tương ứng để thay thế
        $urlMappings = $this->prepareUrlNameMappings();
        
        // Xử lý từng URL tìm được
        foreach ($allUrls as $url) {
            // Nếu URL là localhost, thêm http://
            if (strpos($url, 'localhost') === 0) {
                $fullUrl = 'http://' . $url;
            } else {
                $fullUrl = $url;
            }
            
            // Trích xuất ID từ URL
            $parts = explode('/', $url);
            $id = end($parts);
            
            // Xác định loại URL và tên hiển thị phù hợp
            $linkText = $url; // Mặc định là URL gốc
            
            // Kiểm tra xem URL có trong mapping không
            if (isset($urlMappings[$url]) || isset($urlMappings[$fullUrl])) {
                $linkText = $urlMappings[$url] ?? $urlMappings[$fullUrl];
            } 
            // Hoặc kiểm tra theo pattern URL
            else {
                if (strpos($url, '/hotels/') !== false) {
                    $hotel = Hotel::find($id);
                    if ($hotel) $linkText = "Khách sạn " . $hotel->name;
                } 
                elseif (strpos($url, '/destination-detail/') !== false) {
                    $place = Place::find($id);
                    if ($place) $linkText = "Địa điểm " . $place->name;
                } 
                elseif (strpos($url, '/tour/') !== false) {
                    $tour = Tour::find($id);
                    if ($tour) $linkText = "Tour " . $tour->name;
                } 
                elseif (strpos($url, '/packages/') !== false) {
                    $package = Package::find($id);
                    if ($package) $linkText = "Gói " . $package->name;
                }
            }
            
            // Thay thế URL với thẻ a
            $escapedUrl = preg_quote($url, '/');
            $reply = preg_replace('/(?<!href="|src=")' . $escapedUrl . '/i', 
                '<a href="' . $fullUrl . '" target="_blank">' . $linkText . '</a>', $reply, 1);
        }
        
        // Đảm bảo mỗi mục (bắt đầu với dấu - hoặc các biểu tượng emoji phổ biến) có khoảng cách phù hợp
        $reply = preg_replace('/(- (?:🏨|🚍|📦|📍).*?)(\n[^-\n])/s', '$1\n\n$2', $reply);
        
        // Đảm bảo có khoảng cách giữa các đoạn văn bản
        $reply = preg_replace('/(\n)(?!\n)([^-\s])/m', "\n\n$2", $reply);
        
        return $reply;
    }
    
    /**
     * Chuẩn bị mapping từ URLs sang tên thực thể tương ứng
     */
    private function prepareUrlNameMappings()
    {
        $mappings = [];
        
        // Xử lý Hotels
        $hotels = Hotel::select('id', 'name')->get();
        foreach ($hotels as $hotel) {
            $url = url("/hotels/{$hotel->id}");
            $mappings[$url] = "Khách sạn {$hotel->name}";
        }
        
        // Xử lý Places
        $places = Place::select('id', 'name')->get();
        foreach ($places as $place) {
            $url = url("/destination-detail/{$place->id}");
            $mappings[$url] = "Địa điểm {$place->name}";
        }
        
        // Xử lý Tours
        $tours = Tour::select('id', 'name')->get();
        foreach ($tours as $tour) {
            $url = url("/tour/{$tour->id}");
            $mappings[$url] = "Tour {$tour->name}";
        }
        
        // Xử lý Packages
        $packages = Package::select('id', 'name')->get();
        foreach ($packages as $package) {
            $url = url("/packages/{$package->id}");
            $mappings[$url] = "Gói {$package->name}";
        }
        
        return $mappings;
    }

    /**
     * Tìm các địa điểm (Place) xuất hiện trong câu hỏi của người dùng
     */
    private function findPlacesInMessage($message)
    {
        // Helper to normalize location names
        $normalize = function($str) {
            $str = preg_replace('/^(Tỉnh|Thành phố|Thị xã|Quận|Huyện)\s+/iu', '', $str);
            return trim($str);
        };

        $normalizedMessage = $normalize($message);

        $provinces = \App\Models\Province::select('id', 'name')->get();
        $districts = \App\Models\District::select('id', 'name')->get();
        $matched = collect();

        foreach ($provinces as $province) {
            $provinceName = $normalize($province->name);
            // So khớp không phân biệt hoa thường, bỏ tiền tố
            if (mb_stripos($normalizedMessage, $provinceName) !== false) {
                $matched->push($province);
            }
        }
        foreach ($districts as $district) {
            $districtName = $normalize($district->name);
            if (mb_stripos($normalizedMessage, $districtName) !== false) {
                $matched->push($district);
            }
        }

        return $matched;
    }

    /**
     * Build context string from retrieved hotels, tours, packages
     */
    private function buildContextFromRetrieved($hotels, $tours, $packages,$places): string
    {
        $context = "";

        // Hotels
        foreach ($hotels as $hotel) {
            $context .= "- Khách sạn: {$hotel->name} -" . ($hotel->desc ?? 'Không có mô tả') . "\n";
            $context .= "  Địa chỉ: {$hotel->address}";
            if (!is_null($hotel->star_rating)) {
                $context .= " | Xếp hạng: {$hotel->star_rating} sao";
            }
            $context .= "\n  🔗 Link: " . url("/hotels/{$hotel->id}") . "\n\n";
        }

        foreach ($places as $place) {
            $context .= "-Địa điểm: {$place->name} -" . ($place->desc ?? 'Không có mô tả') . "\n";
            $info = [];
            if ($place->tag) {
                $info[] = "Thẻ: {$place->tag}";
            }
            if ($place->lat && $place->lon) {
                $info[] = "Vị trí: ({$place->lat}, {$place->lon})";
            }
            if ($place->address) {
                $info[] = "Địa chỉ: {$place->address}";
            }
            if (!empty($info)) {
                $context .= "  " . implode(" | ", $info) . "\n";
            }
            $context .= "Link: " . url("/destination-detail/{$place->id}") . "\n\n";
        }
        // Tours
        foreach ($tours as $tour) {
            $placeNames = $tour->places->pluck('name')->join(', ');
            $context .= "- Tour: {$tour->name} - " . ($tour->desc ?? 'Không có mô tả') . "\n";
            $context .= "Từ: {$tour->start_date} → {$tour->end_date} | 💰 Giá: {$tour->price} VND\n";
            if (!empty($placeNames)) {
                $context .= "Lịch trình: $placeNames\n";
            }
            $context .= "Link: " . url("/tour/{$tour->id}") . "\n\n";
        }

        // Packages
        foreach ($packages as $pkg) {
            $context .= "- Gói: {$pkg->name} - " . ($pkg->desc ?? 'Không có mô tả') . "\n";
            $context .= "  Giá: {$pkg->price} VND\n";
            if ($pkg->tour && $pkg->tour->places) {
                $placeNames = $pkg->tour->places->pluck('name')->join(', ');
                $context .= "  Lịch trình: $placeNames\n";
            }
            $context .= "  Link: " . url("/packages/{$pkg->id}") . "\n\n";
        }

        return $context;
    }

   private function buildContextFromDatabase(): string
{
    $context = "";

    // 📦 GÓI DỊCH VỤ
    $packages = Package::select('id', 'name', 'desc', 'price', 'duration', 'people')
        ->orderByDesc('updated_at')->take(10)->get();

    foreach ($packages as $pkg) {
        $context .= "- 📦 Gói: {$pkg->name} - " . ($pkg->desc ?? 'Không có mô tả') . "\n";
        $context .= "  🕒 Thời lượng: {$pkg->duration} ngày | 👥 Số người: {$pkg->people} | 💰 Giá: {$pkg->price} VND\n";
        $context .= "  🔗 Link: " . url("/packages/{$pkg->id}") . "\n\n";
    }

    // 🚍 TOUR DU LỊCH
    $tours = Tour::with('places')->select('id', 'name', 'desc', 'start_date', 'end_date', 'price')
        ->orderByDesc('updated_at')->take(10)->get();

    foreach ($tours as $tour) {
        $placeNames = $tour->places->pluck('name')->join(', ');
        $context .= "- 🚍 Tour: {$tour->name} - " . ($tour->desc ?? 'Không có mô tả') . "\n";
        $context .= "  📅 Từ: {$tour->start_date} → {$tour->end_date} | 💰 Giá: {$tour->price} VND\n";
        if (!empty($placeNames)) {
            $context .= "  🗺️ Lịch trình: $placeNames\n";
        }
        $context .= "  🔗 Link: " . url("/tour/{$tour->id}") . "\n\n";
    }

    // 📍 ĐỊA ĐIỂM
    $places = Place::select('id', 'name', 'desc', 'tag', 'lat', 'lon')
        ->orderByDesc('updated_at')->take(10)->get();

    foreach ($places as $place) {
        $context .= "- 📍 Địa điểm: {$place->name} - " . ($place->desc ?? 'Không có mô tả') . "\n";
        $info = [];
        if ($place->tag) {
            $info[] = "🏷️ Thẻ: {$place->tag}";
        }
        if ($place->lat && $place->lon) {
            $info[] = "📌 Vị trí: ({$place->lat}, {$place->lon})";
        }
        if (!empty($info)) {
            $context .= "  " . implode(" | ", $info) . "\n";
        }
        $context .= "  🔗 Link: " . url("/destination-detail/{$place->id}") . "\n\n";
    }

    // 🏨 KHÁCH SẠN
    $hotels = Hotel::select('id', 'name', 'desc', 'address', 'star_rating')
        ->orderByDesc('updated_at')->take(10)->get();

    foreach ($hotels as $hotel) {
        $context .= "- 🏨 Khách sạn: {$hotel->name} - " . ($hotel->desc ?? 'Không có mô tả') . "\n";
        $context .= "  📍 Địa chỉ: {$hotel->address}";
        if (!is_null($hotel->star_rating)) {
            $context .= " | ⭐ Xếp hạng: {$hotel->star_rating} sao";
        }
        $context .= "\n  🔗 Link: " . url("/hotels/{$hotel->id}") . "\n\n";
    }

    return $context;
}

}

