<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\frontend\ServiceController;
use App\Http\Controllers\frontend\PackageController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\FacebookLoginController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\DestinationController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
Route::get('/package', [PackageController::class, 'index'])->name('package.index');
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');

Route::get('/login', [GoogleLoginController::class, 'index'])->name('login.index');

Route::get('/google/login', [GoogleLoginController::class, 'provider'])->name('google.login');
Route::get('/google/callback', [GoogleLoginController::class, 'callbackHandle'])->name('google.login.callback');

Route::get('/facebook/login', [FacebookLoginController::class, 'provider'])->name('facebook.login');
Route::get('/facebook/callback', [FacebookLoginController::class, 'callbackHandle'])->name('facebook.login.callback');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');




//---------------Destination---------------
Route::get('/destination', [DestinationController::class, 'index'])->name('destination.index');
Route::get('/destination-detail/{id}', [DestinationController::class, 'detail'])->name('destination.detail');





Route::post('/register/sub', [RegisterController::class, 'register'])->name('auth.reg');

