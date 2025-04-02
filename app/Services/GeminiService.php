<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{

    protected $goMapsService;

    protected $apiKey;
    protected $apiUrl;

    public function __construct(MapAPIService $goMapsService)
    {
        $this->goMapsService = $goMapsService;
        $this->apiKey = env('GEMINI_API_KEY');
        $this->apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent"; // Cập nhật model
    }

    function getWikipediaImage($placeName)
    {
        $result = $this->goMapsService->geocode($placeName);
        if (isset($result[0]['lat']) && isset($result[0]['lon'])) {
            $lat = $result[0]['lat'] ?? null;
            $lon = $result[0]['lon'] ?? null;
            if ($lat && $lon) {
                echo "Latitude: $lat, Longitude: $lon";
            } else {
                echo "Không tìm thấy tọa độ!";
            }
        } else {
            if (isset($result['lat']) && isset($result['lat'])){
                $lat = $result['lat'] ?? null;
                $lon = $result['lon'] ?? null;
                echo "Latitude2: $lat, Longitude2: $lon";
            }
            echo "Dữ liệu trả về không hợp lệ!";
        }
        echo "địa điểm: $placeName";
        $url = "https://graph.mapillary.com/images?access_token=MLY|9769366856460262|4f4d94c3a215987a89b4d3bafbba3ba4&fields=id,thumb_1024_url&closeto=$lon,$lat";

        dd($url);

    }


//    function updatePlacesWithImages(&$places) {
////        foreach ($places as $key => &$place) {
////            if (!empty($place[0])) {
////                $image = $this->getWikipediaImage($place[0]);
////                dd($image);
////                $place["Hình ảnh"] = $image;
////            }
////        }
//        $apiKey = "AlzaSypGYiFolXtBsAIjcR_nRfEUKjOAwt0N0Zf"; // Thay bằng API key của bạn
//        $placeName = "Rừng tràm Trà Sư";
//        $url = "https://app.gomaps.pro/api/v1/places/search?query=" . urlencode($placeName) . "&apiKey=" . $apiKey;
//        dd($url);
//        $response = Http::get($url)->json();
//        print_r($response);
//
//
//
//    }

    public function generateItinerary($address, $days, $startDate, $endDate, $budget, $currencyCode, $interest, $adults, $children_1, $children_2, $placename, $transportation)
    {
        $prompt = "Lên kế hoạch du lịch tại $address, mô tả chi tiết (Sáng, trưa, chiều, tối làm gì ăn và ngủ ở đâu) chỉ bao gồm các địa điểm $placename (có thể ít hơn hay loại bỏ một số địa điểm nếu số ngày du lịch có hạn) trong $days ngày (từ ngày $startDate đến $endDate) bằng phương tiện di chuyển: $transportation với số lượng (người trưởng thành: $adults, trẻ em từ 2 đến 10 tuổi: $children_2, trẻ em dưới 2 tuổi: $children_1). Nơi bắt đầu du lịch là $address, tôi cần có đầy đủ các lần di chuyển mỗi khi tham quan, ăn uống, nghỉ chân, mỗi lần di chuyển cần có: Điểm xuất phát → Điểm đến, Khoảng cách (km/m), Phương tiện di chuyển phù hợp, Thời gian di chuyển (phút, số cụ thể) và làm ơn bỏ 'tùy thuộc vào điểm xuất phát và tốc độ di chuyển' đi giùm tôi.
        Sở thích: $interest. Ngân sách: $budget $currencyCode. KHÔNG ĐƯA RA LƯU Ý HAY GỢI Ý GÌ THÊM


        cấu trúc dạng:
            **Ngày **
                *Sáng*
                    [Ăn sáng]
                        - Tên địa điểm ăn sáng
                    [Di chuyển]
                        - Điểm đi: vị trí, tên địa điểm bắt đầu di chuyển
                        - Điểm đến: vị trí, tên địa điểm muốn đến
                        - Khoảng cách: đơn vị (km)
                        - thời gian: giờ/phút
                        - phương tiện di chuyển: đề xuất phương tiện di chuyển (hoặc phương tiện cá nhân của người du lịch)
                    [Địa điểm tham quan]
                        - Tên địa điểm
                        - Thời gian tham quan: từ (thời gian) -> đến (thời gian)
                    [Di chuyển]
                        - Điểm đi: vị trí, tên địa điểm bắt đầu di chuyển
                        - Điểm đến: vị trí, tên địa điểm muốn đến
                        - Khoảng cách: đơn vị (km)
                        - thời gian: giờ/phút
                        - phương tiện di chuyển: đề xuất phương tiện di chuyển (hoặc phương tiện cá nhân của người du lịch)
                    [Địa điểm tham quan]
                        - Tên địa điểm
                        - Thời gian tham quan: từ (thời gian) -> đến (thời gian)
                *Trưa*
                    [Di chuyển]
                        - Điểm đi: vị trí, tên địa điểm bắt đầu di chuyển
                        - Điểm đến: vị trí, tên địa điểm muốn đến
                        - Khoảng cách: đơn vị (km)
                        - thời gian: giờ/phút
                        - phương tiện di chuyển: đề xuất phương tiện di chuyển (hoặc phương tiện cá nhân của người du lịch)
                    [Ăn Trưa]
                        - Tên địa điểm ăn trưa
                *Chiều*
                    [Di chuyển]
                        - Điểm đi: vị trí, tên địa điểm bắt đầu di chuyển
                        - Điểm đến: vị trí, tên địa điểm muốn đến
                        - Khoảng cách: đơn vị (km)
                        - thời gian: giờ/phút
                        - phương tiện di chuyển: đề xuất phương tiện di chuyển (hoặc phương tiện cá nhân của người du lịch)
                    [Địa điểm tham quan]
                        - Tên địa điểm
                        - Thời gian tham quan: từ (thời gian) -> đến (thời gian)
                    [Di chuyển]
                        - Điểm đi: vị trí, tên địa điểm bắt đầu di chuyển
                        - Điểm đến: vị trí, tên địa điểm muốn đến
                        - Khoảng cách: đơn vị (km)
                        - thời gian: giờ/phút
                        - phương tiện di chuyển: đề xuất phương tiện di chuyển (hoặc phương tiện cá nhân của người du lịch)
                    [Địa điểm tham quan]
                        - Tên địa điểm
                        - Thời gian tham quan: từ (thời gian) -> đến (thời gian)
                *Tối*
                    [Di chuyển]
                        - Điểm đi: vị trí, tên địa điểm bắt đầu di chuyển
                        - Điểm đến: vị trí, tên địa điểm muốn đến
                        - Khoảng cách: đơn vị (km)
                        - thời gian: giờ/phút
                        - phương tiện di chuyển: đề xuất phương tiện di chuyển (hoặc phương tiện cá nhân của người du lịch)
                    [Ăn tối]
                        - Tên địa điểm ăn tối
                    [Di chuyển]
                        - Điểm đi: vị trí, tên địa điểm bắt đầu di chuyển
                        - Điểm đến: vị trí, tên địa điểm muốn đến
                        - Khoảng cách: đơn vị (km)
                        - thời gian: giờ/phút
                        - phương tiện di chuyển: đề xuất phương tiện di chuyển (hoặc phương tiện cá nhân của người du lịch)
                    [Địa điểm tham quan]
                        - Tên địa điểm
                        - Thời gian tham quan: từ (thời gian) -> đến (thời gian)
                    [Di chuyển]
                        - Điểm đi: vị trí, tên địa điểm bắt đầu di chuyển
                        - Điểm đến: vị trí, tên địa điểm muốn đến
                        - Khoảng cách: đơn vị (km)
                        - thời gian: giờ/phút
                        - phương tiện di chuyển: đề xuất phương tiện di chuyển (hoặc phương tiện cá nhân của người du lịch)
                    [Chỗ ngủ]
                        - Tên địa điểm nghỉ chân qua đêm
//
        ";












        $response = Http::post($this->apiUrl . "?key=" . $this->apiKey, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);

        $plan = $response->json();
        $plan = $plan['candidates'][0]['content']['parts'][0]['text'];
        dd($plan);

        $plan = str_replace('*', '', $plan);




        $lines = explode("\n", $plan);
        $result = [];
        $skip = false;
        $currentDay = null;
        $timeSlot = null;

        foreach ($lines as $line => $value) {
            $value = trim($value);

            if ($value == '"Lưu ý"' || $value == '"Lời khuyên"') {
                $skip = true;
                continue;
            }

            if ($skip) {
                continue;
            }

            // Kiểm tra dòng "Ngày"
            if (preg_match("/^Ngày \d+:/", $value)) {
                $currentDay = $value;
                $result[$currentDay] = [];
                $timeSlot = null; // Reset time slot cho ngày mới
                continue;
            }
//            dd($result);

            if (preg_match("/^\s*(Sáng|Trưa|Chiều|Tối):/", $value, $matches)) {
                $timeSlot = trim($matches[1]);
                $result[$currentDay][$timeSlot] = [];
                continue;
            }

            if ($currentDay !== null && $timeSlot !== null && !empty($value)) {
                $result[$currentDay][$timeSlot][] = $value;
            }
        }


//        dd($result);


        return $result;
    }
    public function getTourismInfo($address, $interests = [])
    {
        $prompt = "Hãy cung cấp thông tin về các địa điểm du lịch nổi tiếng nhất của khu vực $address.";

        if (!empty($interests)) {
            $prompt .= " Lọc theo sở thích: " . implode(", ", $interests) . ".";
        }

        $prompt .= " Bao gồm:
        - Tên các địa điểm du lịch ( các địa điểm cụ thể đúng tên có thể tìm kiếm trên google map )
        - Loại địa điểm (ví dụ: di tích lịch sử, công viên, bảo tàng)
        - giờ hoạt động (giờ mở cửa và giờ đóng cửa tôi chỉ muốn con số cụ thể nếu là cả 1 khu du lịch thì giờ của cả khu thay vì quán không mở ngoặc mô tả gì thêm). Không lưu ý và khuyên gì thêm, chỉ các địa điểm, càng nhiều càng tốt
        - Các thẻ (khóa là 'Tag') liên quan (các tên tác cách nhau bằng ', ')
        - Kiểu cấu trúc sẽ như thế này
        1.  **Tên:** Tên địa điểm
            *   **Loại:** Loại địa điểm
            *   **Giờ hoạt động:** giờ:phút - giờ:phút
            *   **Tag:** tag1, tag2, ...
        - Không cần mở bài kết bài, tôi chỉ cần như mẫu trên";

        do {
            $response = Http::post($this->apiUrl . "?key=" . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            $places = $response->json();
        } while (!isset($places['candidates']));

        $places = $places['candidates'][0]['content']['parts'][0]['text'];


        $places = str_replace('*', '', $places);

//        dd($places);

        $lines = explode("\n", $places);
        $result = [];
        $skip = false;
        foreach ($lines as $line => $value) {
            $value = trim($value);
            if ($value == '"Lưu ý"' || $value == '"Lời khuyên"') {
                $skip = true;
                continue;
            }

            if ($skip) {
                continue;
            }
            if (preg_match("/^\d+\.\s/", $value)) {
                $value = preg_replace('/^\d+\.\s*/', '', $value);
                $result[$value] = [];
            }
            if ($value != ""){
                $lastKey = array_key_last($result);

                if (strpos($value, ":") !== false) {
                    list($key, $val) = explode(":", $value, 2);
                    $result[$lastKey][trim($key)] = trim($val);
                } else {
                    $result[$lastKey][] = $value;
                }
            }
        }

        $result = array_filter($result, fn($key) => !empty($key), ARRAY_FILTER_USE_KEY);
        foreach ($result as $key => $value) {
            if (isset($value["Tag"])) {
                $tags = explode(", ", $value["Tag"]);
                $result[$key]["Tag"] = $tags;
            }
        }
        return $result;
    }
}
