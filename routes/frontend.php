<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\frontend\ServiceController;
use App\Http\Controllers\frontend\PackageController;
use App\Http\Controllers\frontend\BookingController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\FacebookLoginController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\PlaceController;
use App\Http\Controllers\frontend\ReviewController;
use App\Http\Controllers\frontend\ExploreTourController;
use App\Http\Controllers\frontend\GalleryController;
use App\Http\Controllers\frontend\GuideController;
use App\Http\Controllers\frontend\TestimonialController;
use App\Http\Controllers\frontend\TourController;
use App\Http\Controllers\frontend\ErrorController;
use App\Http\Controllers\frontend\ScheduleController;
use App\Http\Controllers\frontend\ChatbotController;
use App\Http\Controllers\frontend\ProfileController;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\frontend\GoMapsController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\frontend\ProvinceController;




Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
Route::get('/package', [PackageController::class, 'index'])->name('package.index');

//Hotels
Route::get('/hotels/{id}', [App\Http\Controllers\frontend\HotelController::class, 'show'])->name('hotels.show');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::POST('/login-local', [LoginController::class, 'login'])->name('login.login');
Route::get('/privacy', [LoginController::class, 'privacy'])->name('login.privacy');
Route::get('/terms', [LoginController::class, 'terms'])->name('login.terms');

Route::get('/google/login', [GoogleLoginController::class, 'provider'])->name('google.login');
Route::get('/google/callback', [GoogleLoginController::class, 'callback'])->name('google.login.callback');

Route::get('/facebook/login', [FacebookLoginController::class, 'provider'])->name('facebook.login');
Route::get('/facebook/callback', [FacebookLoginController::class, 'callback'])->name('facebook.login.callback');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::post('/register/sub', [RegisterController::class, 'register'])->name('auth.reg');
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');



// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});

Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

Route::get('/tour', [ExploreTourController::class, 'index'])->name('tour.index');
Route::get('tour/{id}', [TourController::class, 'detail'])->name('tour.detail');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

Route::get('/guide', [GuideController::class, 'index'])->name('guide.index');

Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial.index');

Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial.index');


//---------------Schedule---------------//
Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
Route::get('/place-details', [ScheduleController::class, 'searfchPlace'])->name('place');

Route::get('/map', [ScheduleController::class, 'map'])->name('map');
Route::get('/build-schedule', [ScheduleController::class, 'build_schedule'])->name('build-schedule');
Route::get('/get-event', [ScheduleController::class, 'getEventAndActivity'])->name('get-event');
Route::get('/directions', [ScheduleController::class, 'getDirections'])->name('directions');
//---------------End Schedule---------------//



//---------------Chatbot---------------//
Route::post('/chatbot', [ChatbotController::class, 'sendMessage'])->name('chatbot');
//---------------End Chatbot---------------//

Route::get('/404', [ErrorController::class, 'index'])->name('404');



//---------------Destination---------------//
Route::get('/destination', [PlaceController::class, 'index'])->name('destination.index');
Route::get('/destination-detail/{id}', [PlaceController::class, 'detail'])->name('destination.detail');
Route::get('/destination/more', [PlaceController::class, 'more'])->name('destination.more');
Route::get('/destination/search', [PlaceController::class, 'search'])->name('destination.search');
Route::get('/destination/sort', [PlaceController::class, 'sort'])->name('destination.sort');
//---------------Destination---------------//



Route::post('{type}/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('tour', [TourController::class, 'index'])->name('tour.index');
Route::post('tour/{id}/reviews', [ReviewController::class, 'storeTourReview'])->name('tour.reviews.store');
Route::get('/booking/create/tour/{id}', [BookingController::class, 'createTour'])->name('booking.tour.create');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

Route::get('/map-route', [ScheduleController::class, 'showRoute'])->name('map.route');

Route::get('/map-search', [ScheduleController::class, 'searchAddress'])->name('map.search');


//---------------Logout---------------//
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');




Route::get('/api/provinces', [ProvinceController::class, 'getProvinces']);
Route::get('/districts/{provinceId}', [ProvinceController::class, 'getDistricts']);
Route::get('/wards/{districtId}', [ProvinceController::class, 'getWards']);
Route::get('/api/search', [ScheduleController::class, 'search']);


Route::get('/weather', [WeatherController::class, 'getWeather']);
