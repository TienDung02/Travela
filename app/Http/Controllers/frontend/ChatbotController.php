<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\GeminiService;
use App\Models\Package;
use App\Models\Tour;
use App\Models\Place;
use App\Models\Hotel;

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

        // Tạo ngữ cảnh từ database
        $context = $this->buildContextFromDatabase();

        // Prompt đầy đủ gửi tới Gemini
        $prompt = <<<EOT
Bạn là trợ lý AI của hệ thống Travela.

Dưới đây là một số dữ liệu hiện có trong hệ thống (gói du lịch, tour, địa điểm, khách sạn):

$context

Hãy trả lời ngắn gọn, đúng trọng tâm. Nếu có nội dung liên quan, hãy gợi ý kèm link cụ thể. **không cần dùng cú pháp Markdown [link](url)**. Hãy chỉ hiển thị link đơn giản

Câu hỏi người dùng: $userMessage
EOT;

        // Ghi log prompt
        Log::info("🟦 Prompt gửi Gemini:\n" . $prompt);

        try {
            // Gọi Gemini
            $reply = $this->geminiService->chatBot(['message' => $prompt]);

            // Ghi log phản hồi
            Log::info("🟩 Phản hồi từ Gemini:\n" . $reply);

            return response()->json([
                'reply' => $reply
            ]);
        } catch (\Throwable $e) {
            // Ghi log lỗi
            Log::error("🟥 Lỗi gọi Gemini API: " . $e->getMessage());

            return response()->json([
                'reply' => "Xin lỗi, đã xảy ra lỗi khi liên hệ với trợ lý AI."
            ]);
        }
    }

   private function buildContextFromDatabase(): string
{
    $context = "";

    // 📦 GÓI DỊCH VỤ
    $packages = Package::select('id', 'name', 'desc', 'price', 'duration', 'people')
        ->orderByDesc('updated_at')->take(10)->get();

    foreach ($packages as $pkg) {
        $context .= "- 📦 Gói: {$pkg->name} – " . ($pkg->desc ?? 'Không có mô tả') . "\n";
        $context .= "  🕒 Thời lượng: {$pkg->duration} ngày | 👥 Số người: {$pkg->people} | 💰 Giá: {$pkg->price} VND\n";
        $context .= "  🔗 Link: " . url("/packages/{$pkg->id}") . "\n\n";
    }

    // 🚍 TOUR DU LỊCH
    $tours = Tour::with('places')->select('id', 'name', 'desc', 'start_date', 'end_date', 'price')
        ->orderByDesc('updated_at')->take(10)->get();

    foreach ($tours as $tour) {
        $placeNames = $tour->places->pluck('name')->join(', ');
        $context .= "- 🚍 Tour: {$tour->name} – " . ($tour->desc ?? 'Không có mô tả') . "\n";
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
        $context .= "- 📍 Địa điểm: {$place->name} – " . ($place->desc ?? 'Không có mô tả') . "\n";
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
        $context .= "- 🏨 Khách sạn: {$hotel->name} – " . ($hotel->desc ?? 'Không có mô tả') . "\n";
        $context .= "  📍 Địa chỉ: {$hotel->address}";
        if (!is_null($hotel->star_rating)) {
            $context .= " | ⭐ Xếp hạng: {$hotel->star_rating} sao";
        }
        $context .= "\n  🔗 Link: " . url("/hotels/{$hotel->id}") . "\n\n";
    }

    return $context;
}

}
