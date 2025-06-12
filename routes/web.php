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

