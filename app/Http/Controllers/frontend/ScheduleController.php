<?php

namespace App\Http\Controllers\frontend;
use App\Services\GeoNamesService;
use App\Services\GoMapsService;
use App\Services\WeatherService;
use Avcodewizard\GooglePlaceApi\GooglePlacesApi;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ScheduleController
{
    protected $goMapsService;
    protected $geoNamesService;
    protected $weatherService;
    public function __construct(GoMapsService $goMapsService,GeoNamesService $geoNamesService,WeatherService $weatherService)
    {
        $this->goMapsService = $goMapsService;
        $this->geoNamesService = $geoNamesService;
        $this->weatherService = $weatherService;

    }
    public function index()
    {
        $currencies = Currency::query()->get();
        return view('frontend.schedule.index', compact('currencies'));
    }
    public function searfchPlace()
    {
        Log::info('Đã vào hàm searchPlace');
        echo '123';
        exit();
    }

    public function map(Request $request)
    {
        $address = $request->input('address');
        $data = null;
        $error = null;

        if ($address) {
            $result = $this->goMapsService->geocode($address);

            if (!$result || $result['status'] !== 'OK') {
                $error = 'Không tìm thấy địa điểm.';
            } else {
                $data = $result['results'][0];
            }
        }
        $currencies = Currency::query()->get();


        $weather = $this->weatherService->getWeatherByCity($address);

        if (!$weather) {
            return view('frontend.weather', [
                'error' => "Không thể lấy thông tin thời tiết của thành phố: {$address}. Vui lòng thử lại!"
            ]);
        }

        return view('frontend.schedule.index', compact('data', 'currencies', 'weather', 'error'));
    }
    public function getDirections(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');

        if (!$origin || !$destination) {
            return response()->json(['error' => 'Vui lòng nhập điểm đi và điểm đến.'], 400);
        }

        $result = $this->goMapsService->getDirections($origin, $destination);

        return response()->json($result);
    }
    public function getWeatherByCity($city, $days = 3)
    {
        $url = "https://api.weatherapi.com/v1/forecast.json?key={$this->apiKey}&q={$city}&days={$days}";

        $response = Http::get($url);

        if ($response->failed()) {
            \Log::error("Weather API Error: " . $response->body());
            return null;
        }

        return $response->json();
    }
}
