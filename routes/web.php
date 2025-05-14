<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\BookingController;
use App\Http\Controllers\frontend\PackageController;

Route::get('/packages/{id}', [PackageController::class, 'show'])->name('package.show');
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/booking/create/{id}', [BookingController::class, 'create'])->name('booking.create');
require base_path('routes/frontend.php');
require base_path('routes/backend.php');



