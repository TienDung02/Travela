<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\BookingController;
use App\Http\Controllers\frontend\PackageController;

Route::get('/packages/{id}', [PackageController::class, 'show'])->name('package.show');
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/booking/create/{id}', [BookingController::class, 'create'])->name('booking.create');
require base_path('routes/frontend.php');
require base_path('routes/backend.php');



use App\Http\Controllers\GoogleCalendarController;

// 1. Route để người dùng bắt đầu đăng nhập Google Calendar
Route::get('/google-calendar/auth', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.login');

// 2. Callback sau khi Google xác thực thành công
Route::get('/calendar/oauth/callback', [GoogleCalendarController::class, 'handleGoogleCallback']);

// 3. Route xử lý khi user bấm nút "Thêm vào Google Calendar"
Route::post('/calendar/add', [GoogleCalendarController::class, 'addScheduleToCalendar'])->name('calendar.add');


Route::get('/tz-check', function () {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    return now()->toDateTimeString();
});

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

Route::get('/view-laravel-log', function () {
    $logPath = storage_path('logs/laravel.log');

    // Nếu file chưa tồn tại → tạo và ghi log mặc định
    if (!File::exists($logPath)) {
        Log::info('📄 File laravel.log vừa được tạo tự động tại ' . now());
    }

    // Đảm bảo file đã tồn tại sau khi log
    if (!File::exists($logPath)) {
        return "❌ Không thể tạo file log.";
    }

    $content = File::get($logPath);
    return response('<pre>' . e($content) . '</pre>');
});