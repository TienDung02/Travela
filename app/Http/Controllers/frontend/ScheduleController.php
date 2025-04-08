<?php

namespace App\Http\Controllers\frontend;
use App\Models\Preference;
use App\Services\ProvinceService;
use App\Services\MapAPIService;
use App\Services\WeatherService;
use App\Services\GeminiService;
use App\Services\WikipediaService;
use App\Services\RapidApiService;
use App\Services\GoogleMapsScraper;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScheduleController
{
    protected $goMapsService;
    protected $weatherService;
    protected $provinceService;
    protected $geminiService;
    protected $wikipediaService;
    protected $rapidApiService;


    public function __construct(MapAPIService $goMapsService, ProvinceService $provinceService, WeatherService $weatherService, GeminiService $geminiService, WikipediaService $wikipediaService, RapidApiService $rapidApiService)
    {
        $this->goMapsService = $goMapsService;
        $this->provinceService = $provinceService;
        $this->weatherService = $weatherService;
        $this->geminiService = $geminiService;
        $this->wikipediaService = $wikipediaService;
        $this->rapidApiService = $rapidApiService;

    }
    public function index()
    {
        $currencies = Currency::query()->get();
        $preferences = Preference::query()->get();
        return view('frontend.schedule.index', compact('currencies', 'preferences'));
    }
    public function testMap($placeName)
    {
        $scraper = new GoogleMapsScraper();
        $data = $scraper->getPlaceInfo($placeName);

        return response()->json($data);
    }

    public function map(Request $request)
    {
        $address = $request->input('address');
        $address = str_replace(['Tỉnh ', 'Thành phố '], '', $address);
        $data = null;
        $error = null;

        $endpoint = 'weather';
        $params = [
            'query' => $address,
        ];

        $data = $this->rapidApiService->fetchData($params);

        if ($address) {
            $result = $this->goMapsService->geocode($address); // Gọi API Nominatim

            if (!$result || empty($result)) {
                $error = 'Không tìm thấy địa điểm.';
            } else {
                $data = $result[0]; // Nominatim trả về một mảng các kết quả, lấy kết quả đầu tiên
            }
        }
        if (!empty($data)) {
            $lat = $data['lat'];
            $lon = $data['lon'];
        } else {
            $lat = 10.8206;
            $lon = 106.6281;
        }

        $currencies = Currency::query()->get();
        $weather = $this->weatherService->getWeatherByCity($address);

        if (!$weather) {
            return view('frontend.weather', [
                'error' => "Không thể lấy thông tin thời tiết của thành phố: {$address}. Vui lòng thử lại!"
            ]);
        }

        $address = $request->input('address');
        $address = str_replace(['Tỉnh ', 'Thành phố '], '', $address);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $days = 3;
        if ($startDate && $endDate) {
            $days = (new \DateTime($startDate))->diff(new \DateTime($endDate))->days;
        }
        $budget = floatval($request->input('budget', 0));
        $currencyCode = $request->input('currency', 'VND');

        $adults = $request->input('adults');
        $children_1 = $request->input('children-1');
        $children_2 = $request->input('children-2');
        $transportation = $request->input('transportation');

        $interest = $request->input('interest');
        $interest = implode(', ', $interest);

        session([
            'trip_data' => [
                'address' => $address,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'days' => $days,
                'budget' => $budget,
                'currency' => $currencyCode,
                'adults' => $adults,
                'children_1' => $children_1,
                'children_2' => $children_2,
                'transportation' => $transportation,
                'interest' => $interest,
            ]
        ]);

        $preferences = $request->input('interest');

        $places = $this->geminiService->getTourismInfo($address, $preferences);
        $placeNames = array_keys($places);
        foreach ($placeNames as $placeName){
            $placeName = str_replace("Tên:", "", $placeName);
            $info_place = $this->testMap($placeName);
            dd($info_place);
            dd($placeName);
        }
        $placeNames = implode(", ", $placeNames);
//        dd($placeNames);
        $preferences = Preference::query()->get();
        $address = convertVietnameseToLatin($address);

        return view('frontend.schedule.index', compact('data', 'currencies', 'weather', 'error' , 'preferences', 'lat', 'lon', 'address', 'places', 'placeNames'));
    }
    public function build_schedule(Request $request)
    {
//        dd('123');
        $address = $tripData['address'] ?? null;
        $startDate = $tripData['start_date'] ?? null;
        $endDate = $tripData['end_date'] ?? null;
        $days = $tripData['days'] ?? null;
        $budget = $tripData['budget'] ?? null;
        $currencyCode = $tripData['currency'] ?? null;
        $adults = $tripData['adults'] ?? null;
        $children_1 = $tripData['children_1'] ?? null;
        $children_2 = $tripData['children_2'] ?? null;
        $transportation = $tripData['transportation'] ?? null;
        $interest = $tripData['interest'] ?? null;

        session()->forget('trip_data');

        $placeNames = $request->input('placeNames');

        $currencies = Currency::query()->get();
        $preferences = Preference::query()->get();

        $plans = $this->geminiService->generateItinerary($address, $days, $startDate, $endDate, $budget, $currencyCode, $interest, $adults, $children_1, $children_2, $placeNames, $transportation);
        dd($plans);
        return view('frontend.schedule.ajax.schedule-built', compact('plans', 'currencies', 'preferences'));

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


    public function search(Request $request)
    {
        $query = trim($request->query('q', ''));

        if (empty($query)) {
            return response()->json([]);
        }

        $provinces = $this->provinceService->getProvinces();

        if (empty($provinces)) {
            return response()->json([]);
        }

        $filtered = collect($provinces)->filter(function ($province) use ($query) {
            $provinceName = str_replace(['Tỉnh ', 'Thành phố '], '', $province['name']);

            return stripos(mb_strtolower($provinceName), mb_strtolower($query)) === 0;
        })->values()->all();

        return response()->json($filtered);
    }



}
