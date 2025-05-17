<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\BlogManagementController;
use App\Http\Controllers\backend\BookingManagementController;
use App\Http\Controllers\backend\ContactManagementController;
use App\Http\Controllers\backend\InformationManagementController;
use App\Http\Controllers\backend\StatisticManagementController;
use App\Http\Controllers\backend\PackageManagementController;





Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

Route::get('/admin-booking', [BookingManagementController::class, 'index'])->name('admin.booking.index');
Route::get('/admin-contact', [ContactManagementController::class, 'index'])->name('admin.contact.index');
Route::get ('/admin-information', [InformationManagementController::class, 'index'])->name('admin.information.index');
Route::get('/admin-statistic', [StatisticManagementController::class, 'index'])->name('admin.statistic.index');
Route::get('/admin-package', [PackageManagementController::class, 'index'])->name('admin.package.index');



Route::get('/admin-blog', [BlogManagementController::class, 'index'])->name('admin.blog.index');
Route::post('/admin-blog', [BlogManagementController::class, 'store'])->name('admin.blog.store');
Route::put('/admin-blog/{id}', [BlogManagementController::class, 'update'])->name('admin.blog.update');
Route::delete('/admin-blog/{id}', [BlogManagementController::class, 'destroy'])->name('admin.blog.destroy');