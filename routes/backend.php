<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\BlogManagementController;
use App\Http\Controllers\backend\BookingManagementController;
use App\Http\Controllers\backend\ContactManagementController;
use App\Http\Controllers\backend\InformationManagementController;
use App\Http\Controllers\backend\StatisticManagementController;
use App\Http\Controllers\backend\PackageManagementController;
use App\Http\Controllers\backend\PlaceManagementController;
use App\Http\Controllers\backend\TourManagementController;
use Illuminate\Support\Facades\Auth;


Route::prefix('management')->group(function () {

    Route::get('', function () {
        return view('backend.layouts.layout');
    });

    Route::middleware([RoleMiddleware::class . ':Admin'])->group(function () {
        Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    });

    Route::middleware([RoleMiddleware::class . ':Admin,Product manager'])->group(function () {
        Route::get('/admin-booking/create', [BookingManagementController::class, 'create'])->name('admin.booking.create');
        Route::post('/admin-booking', [BookingManagementController::class, 'store'])->name('admin.booking.store');
        Route::get('/admin-booking/{id}/edit', [BookingManagementController::class, 'edit'])->name('admin.booking.edit');
        Route::put('/admin-booking/{id}', [BookingManagementController::class, 'update'])->name('admin.booking.update');
        Route::delete('/admin-booking/{id}', [BookingManagementController::class, 'destroy'])->name('admin.booking.destroy');
        Route::get('/admin-booking', [BookingManagementController::class, 'index'])->name('admin.booking.index');
    });

    Route::middleware([RoleMiddleware::class . ':Admin,Contact manager'])->group(function () {
        Route::get('/admin-contact', [ContactManagementController::class, 'index'])->name('admin.contact.index');
        Route::put('/admin-contact/{id}', [ContactManagementController::class, 'update'])->name('admin.contact.update');
        Route::delete('/admin-contact/{id}', [ContactManagementController::class, 'destroy'])->name('admin.contact.destroy');
    });

    Route::middleware([RoleMiddleware::class . ':Admin'])->group(function () {
        Route::get('/admin-information', [InformationManagementController::class, 'index'])->name('admin.information.index');
        Route::get('/admin-information/create', [InformationManagementController::class, 'create'])->name('admin.information.create');
        Route::post('/admin-information', [InformationManagementController::class, 'store'])->name('admin.information.store');
        Route::get('/admin-information/{id}/edit', [InformationManagementController::class, 'edit'])->name('admin.information.edit');
        Route::put('/admin-information/{id}', [InformationManagementController::class, 'update'])->name('admin.information.update');
        Route::delete('/admin-information/{id}', [InformationManagementController::class, 'destroy'])->name('admin.information.destroy');
    });


    Route::middleware([RoleMiddleware::class . ':Admin,Statistics and reporting manager'])->group(function () {
        Route::get('/admin-statistic', [StatisticManagementController::class, 'index'])->name('admin.statistic.index');
    });

    Route::middleware([RoleMiddleware::class . ':Admin,Packages manager'])->group(function () {
        Route::get('/admin-place', [PlaceManagementController::class, 'index'])->name('admin.place.index');
        Route::post('/admin-place', [PlaceManagementController::class, 'store'])->name('admin.place.store');
        Route::put('/admin-place/{id}', [PlaceManagementController::class, 'update'])->name('admin.place.update');
        Route::delete('/admin-place/{id}', [PlaceManagementController::class, 'destroy'])->name('admin.place.destroy');

        Route::get('/admin-tour', [TourManagementController::class, 'index'])->name('admin.tour.index');
        Route::post('/admin-tour', [TourManagementController::class, 'store'])->name('admin.tour.store');
        Route::put('/admin-tour/{id}', [TourManagementController::class, 'update'])->name('admin.tour.update');
        Route::delete('/admin-tour/{id}', [TourManagementController::class, 'destroy'])->name('admin.tour.destroy');

        Route::get('/admin-package', [PackageManagementController::class, 'index'])->name('admin.package.index');
        Route::post('/admin-package', [PackageManagementController::class, 'store'])->name('admin.package.store');
        Route::put('/admin-package/{id}', [PackageManagementController::class, 'update'])->name('admin.package.update');
        Route::delete('/admin-package/{id}', [PackageManagementController::class, 'destroy'])->name('admin.package.destroy');
    });

    Route::middleware([RoleMiddleware::class . ':Admin,Blogs manager'])->group(function () {
        Route::get('/admin-blog', [BlogManagementController::class, 'index'])->name('admin.blog.index');
        Route::post('/admin-blog', [BlogManagementController::class, 'store'])->name('admin.blog.store');
        Route::put('/admin-blog/{id}', [BlogManagementController::class, 'update'])->name('admin.blog.update');
        Route::delete('/admin-blog/{id}', [BlogManagementController::class, 'destroy'])->name('admin.blog.destroy');
    });


});
