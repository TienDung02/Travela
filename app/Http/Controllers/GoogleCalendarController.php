<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; // ✅ Dòng này quan trọng

class GoogleCalendarController extends Controller
{
    // 1. Chuyển hướng người dùng sang Google để xác thực
    public function redirectToGoogle()
    {
        $client = new Client();
        $client->setClientId(env('GOOGLE_CALENDAR_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CALENDAR_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_CALENDAR_REDIRECT_URI'));
        $client->addScope(Calendar::CALENDAR);

            // ✨ Thêm 2 dòng này
    $client->setAccessType('offline'); // yêu cầu refresh_token
    $client->setPrompt('consent');     // ép hỏi lại dù đã cấp quyền



        return redirect()->away($client->createAuthUrl());
    }

    // 2. Nhận mã xác thực từ Google và lưu token vào session
    public function handleGoogleCallback(Request $request)
    {
        if (!$request->has('code')) {
            return redirect()->back()->withErrors(['Không nhận được mã xác thực từ Google']);
        }

        $client = new Client();
        $client->setClientId(env('GOOGLE_CALENDAR_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CALENDAR_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_CALENDAR_REDIRECT_URI'));

        $token = $client->fetchAccessTokenWithAuthCode($request->code);

        if (isset($token['error'])) {
            return redirect()->back()->withErrors(['Lỗi xác thực: ' . $token['error_description']]);
        }

       session(['google_calendar_token' => $token]);

// 🔁 Quay về trang trước khi login (nếu có), mặc định về trang chủ
$redirectUrl = $request->query('redirect_back') ?? url('/');

return redirect($redirectUrl)->with('success', '✅ Đăng nhập Google Calendar thành công');
 }

    // 3. Thêm sự kiện vào Google Calendar từ built-schedule
 public function addScheduleToCalendar(Request $request)
{
      date_default_timezone_set('Asia/Ho_Chi_Minh'); // ✅ ép local timezone chỉ ở đây
    Log::info('🚀 Bắt đầu xử lý addScheduleToCalendar');

    // ✅ Kiểm tra token
    $token = session('google_calendar_token');
   if (!$token) {
    Log::warning('⚠️ Không có token trong session, trả về JSON redirect login');

    return response()->json([
        'message' => '⚠️ Phiên làm việc đã hết. Vui lòng đăng nhập lại Google.',
        'redirect' => route('google.login') . '?redirect_back=' . urlencode(url()->previous())
    ], 401); // 401 để JS hiểu là lỗi cần login
}


    $client = new Client();
    $client->setClientId(env('GOOGLE_CALENDAR_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CALENDAR_CLIENT_SECRET'));
    $client->setRedirectUri(env('GOOGLE_CALENDAR_REDIRECT_URI'));
    $client->addScope(Calendar::CALENDAR);
    $client->setAccessToken($token);

   if ($client->isAccessTokenExpired()) {
    Log::warning('⚠️ Token đã hết hạn');
    
    if ($client->getRefreshToken()) {
        // Làm mới access token
        $newToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        Log::info('🔁 Refresh token thành công');
        session(['google_calendar_token' => $newToken]); // cập nhật token mới
        $client->setAccessToken($newToken); // gán lại
    } else {
        Log::error('❌ Không có refresh_token, trả về JSON để redirect login');

return response()->json([
    'message' => '❌ Phiên đăng nhập đã hết hạn. Hãy đăng nhập lại.',
    'redirect' => route('google.login') . '?redirect_back=' . urlencode(url()->previous())
], 401);

    }
}


    $service = new Calendar($client);

    // ✅ Lấy dữ liệu form
    $title = $request->input('title', 'Hoạt động');
    $location = $request->input('location', '');
    $description = $request->input('description', 'Lịch trình từ Travela');
 $type = $request->input('type', '');
$timeRange = $request->input('time_range', '');

if (empty($timeRange) || !str_contains($timeRange, '->')) {
    switch ($type) {
        case 'Sáng':
            $timeRange = '08:00 -> 11:00';
            break;
        case 'Trưa':
            $timeRange = '11:00 -> 13:00';
            break;
        case 'Chiều':
            $timeRange = '14:00 -> 17:00';
            break;
        case 'Tối':
            $timeRange = '18:00 -> 22:00';
            break;
        default:
            $timeRange = '08:00 -> 10:00'; // fallback nếu không rõ
    }
}




    $dayIndex = (int)$request->input('day_index', 0);

    Log::info('📥 Dữ liệu từ form:', [
        'title' => $title,
        'location' => $location,
        'description' => $description,
        'time_range' => $timeRange,
        'day_index' => $dayIndex,
    ]);

    // ✅ Ngày mặc định
    $startDate = session('start_date');

if (!$startDate) {
    Log::error('❌ Thiếu ngày bắt đầu (start_date) trong session');
    return back()->withErrors(['Thiếu ngày bắt đầu lịch trình']);
}

$baseDate = Carbon::createFromFormat('Y-m-d', $startDate);
$selectedDate = $baseDate->copy()->addDays($dayIndex)->format('Y-m-d');

Log::info('📆 Ngày sự kiện:', [
    'baseDate' => $baseDate->toDateString(),
    'dayIndex' => $dayIndex,
    'selectedDate' => $selectedDate
]);


    // ✅ Parse thời gian
    if (str_contains($timeRange, '->')) {
        [$startTime, $endTime] = explode('->', $timeRange);
    } else {
        $startTime = '08:00';
        $endTime = '10:00';
    }

    $startDateTime = Carbon::parse($selectedDate . ' ' . trim($startTime))->toRfc3339String();
    $endDateTime = Carbon::parse($selectedDate . ' ' . trim($endTime))->toRfc3339String();

Log::info('⏰ Check sau set timezone:', [
    'php_timezone' => date_default_timezone_get(),
    'start_raw' => $selectedDate . ' ' . trim($startTime),
    'startDateTime' => $startDateTime,
    'endDateTime' => $endDateTime,
]);

    Log::info('⏰ Thời gian sự kiện:', [
        'start' => $startDateTime,
        'end' => $endDateTime
    ]);

    // ✅ Tạo sự kiện
    $event = new Event([
        'summary' => $title,
        'location' => $location,
        'description' => $description,
        'start' => [
            'dateTime' => $startDateTime,
            'timeZone' => 'Asia/Ho_Chi_Minh',
        ],
        'end' => [
            'dateTime' => $endDateTime,
            'timeZone' => 'Asia/Ho_Chi_Minh',
        ],
    ]);

    // 🔁 Ghi log event dưới dạng JSON (không bị lỗi kiểu dữ liệu)
    Log::info('📦 Đối tượng sự kiện JSON:', [
        'event_json' => json_encode($event->toSimpleObject(), JSON_PRETTY_PRINT)
    ]);

    // ✅ Gửi lên Google Calendar
   try {
    $createdEvent = $service->events->insert('primary', $event);

    Log::info('✅ Tạo sự kiện thành công:', [
        'event_id' => $createdEvent->getId(),
        'htmlLink' => $createdEvent->getHtmlLink(), // 👈 URL xem sự kiện
    ]);

    return response()->json([
        'message' => '✅ Đã thêm sự kiện vào Google Calendar!',
        'link' => $createdEvent->getHtmlLink() // 👈 gửi link về cho frontend
    ]);
} catch (\Exception $e) {
    return response()->json([
        'message' => '❌ Lỗi khi thêm sự kiện',
        'error' => $e->getMessage(),
    ], 500);
}

}


}
