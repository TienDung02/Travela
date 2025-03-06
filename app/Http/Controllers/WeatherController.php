<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Http;
class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getWeather(Request $request)
    {
        $city = $request->input('city', 'Da Nang');

        $weather = $this->weatherService->getWeatherByCity($city);

        if (!$weather || !isset($weather['forecast'])) {
            $errorMessage = $weather['error']['message'] ?? "Không thể lấy thông tin thời tiết của thành phố: {$city}. Vui lòng thử lại!";
            return view('frontend.weather', [
                'error' => $errorMessage
            ]);
        }

        return view('frontend.weather', ['weather' => $weather]);
    }




    public function getWeatherByCity($city, $days = 3)
    {
        $url = "https://api.weatherapi.com/v1/forecast.json?key={$this->apiKey}&q={$city}&days={$days}"; // Sử dụng forecast.json để lấy dự báo nhiều ngày

        $response = Http::get($url);

        if ($response->failed()) {
            \Log::error("Weather API Error: " . $response->body());
            return null;
        }

        return $response->json();
    }




}
