<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\frontend\ServiceController;
use App\Http\Controllers\frontend\PackageController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\frontend\ContactController;

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
Route::get('/package', [PackageController::class, 'index'])->name('package.index');
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
