<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
//use app\Helpers;

class WeatherService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('WEATHER_API_KEY');
    }


    public function getWeatherByCity($city)
    {
        $city = convertVietnameseToLatin($city);

        $url = "https://api.weatherapi.com/v1/forecast.json?key={$this->apiKey}&q={$city}&days=3";
        $response = Http::get($url);

        if ($response->failed()) {
            return null;
        }

        return $response->json();
    }

}
