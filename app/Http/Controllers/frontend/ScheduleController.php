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
use App\Services\Map4DService;
use App\Models\Currency;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Promise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class ScheduleController
{
    protected $goMapsService;
    protected $weatherService;
    protected $provinceService;
    protected $geminiService;
    protected $wikipediaService;
    protected $rapidApiService;
    protected $map4DService;


    public function __construct(MapAPIService $goMapsService, ProvinceService $provinceService, WeatherService $weatherService,
                                GeminiService $geminiService, WikipediaService $wikipediaService, RapidApiService $rapidApiService,
                                Map4DService  $map4DService)
    {
        $this->goMapsService = $goMapsService;
        $this->provinceService = $provinceService;
        $this->weatherService = $weatherService;
        $this->geminiService = $geminiService;
        $this->wikipediaService = $wikipediaService;
        $this->rapidApiService = $rapidApiService;
        $this->map4DService = $map4DService;

    }
    public function getThumbnail($query)
    {
        $thumbnail = $this->wikipediaService->getPlaceInfo($query);
        if (!$thumbnail) {
            return response()->json(['error' => 'Không tìm thấy thông tin địa điểm'], 404);
        }
        return response()->json($thumbnail);
    }
    public function getSummary($query)
    {
        $summary = $this->wikipediaService->getPlaceInfo($query);
        if (!$summary) {
            return response()->json(['error' => 'Không tìm thấy thông tin địa điểm'], 404);
        }
        return response()->json($summary);
    }

    public function searchWikidata($keyword)
    {
        $response = Http::get('https://www.wikidata.org/w/api.php', [
            'action' => 'wbsearchentities',
            'search' => $keyword,
            'language' => 'en',
            'format' => 'json'
        ]);

        return $response->json();
    }


    public function showRoute(Request $request)
    {
        $origin = $request->input('origin', '21.0285,105.8522');
        $destination = $request->input('destination', '21.0367,105.8347');
        $mode = $request->input('mode', 'car');

        $routeData = $this->map4DService->getRoute($origin, $destination, $mode);

        if (!$routeData) {
            return back()->with('error', 'Không thể tìm thấy đường đi. Vui lòng thử lại.');
        }

        return view('test', [
            'routeData' => $routeData,
            'origin' => $origin,
            'destination' => $destination,
            'mode' => $mode

        ]);
    }
    public function searchAddress(Request $request)
    {
        $address = $request->input('address');
        if (!$address) {
            return response()->json(['error' => 'Vui lòng nhập địa chỉ'], 400);
        }

        $geocodeResult = $this->map4DService->geocode($address);

        if (!$geocodeResult || empty($geocodeResult['result'])) {
            return response()->json(['error' => 'Không tìm thấy địa chỉ'], 404);
        }
        return response()->json($geocodeResult);
    }
    public function index()
    {

        $currencies = DB::table('currencies')->get();
        $preferences = DB::table('preferences')->get();
        $wikicontent = [];

        return view('frontend.schedule.index', compact('currencies', 'preferences','wikicontent'));
    }
    public function testMap($placeName)
    {
        $scraper = new GoogleMapsScraper();
        $data = $scraper->getPlaceInfo($placeName);

        return response()->json($data);
    }

    public function map(Request $request)
    {
        $address_old = $request->input('address');
        $address = str_replace(['Tỉnh ', 'Thành phố '], '', $address_old);
        $map = null;
        $error = null;

        $endpoint = 'weather';
        $params = [
            'query' => $address,
        ];
        if ($address_old) {
            $result = $this->map4DService->geocode($address_old);

            if (!$result || empty($result)) {
                $error = 'Không tìm thấy địa điểm.';
            } else {
                $map = $result;
            }
        }
        if (!empty($map)) {
            $lat = $map['lat'];
            $lon = $map['lon'];
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

        $preferences = $request->input('interest');

        $places = $this->geminiService->getTourismInfo($address, $preferences);
       
        $placeNames = array_keys($places );
        

        $placeNames = implode(", ", $placeNames);

        $preferences = Preference::query()->get();
        $address = convertVietnameseToLatin($address);

        $params = $request->query();
        $query = http_build_query($params);
        $finalUrl = url('/build-schedule') . '?' . $query;

        $wikicontent = [];
        foreach ($places as &$place){
            $name = cleanLocationString($place['Tên']);
            $origin = $this->map4DService->geocode2($name);
            $place['lat'] = $origin['lat'] ?? '';
            $place['lon'] = $origin['lon'] ?? '';
            
            $wikicontent[$place['Tên']] = $this->wikipediaService->getPlaceInfo($name);

        }
        //dd($placeNames);
        $data = [
            'map' => $map,
            'currencies' => $currencies,
            'weather' => $weather,
            'error' => $error,
            'preferences' => $preferences,
            'lat' => $lat,
            'lon' => $lon,
            'address' => $address,
            'address_old' => $address_old,
            'places' => $places,
            'finalUrl' => $finalUrl,
            'wikicontent' => $wikicontent,
            'for_schedule' => [
                'address' => $address,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'placeNames' => $placeNames,
                'budget' => $budget,
                'currency' => $currencyCode,
                'adults' => $adults,
                'children_1' => $children_1,
                'children_2' => $children_2,
                'transportation' => $transportation,
                'interest' => $interest
            ],
            'for_event' => [
                'address' => $address,
                'start_date' => $startDate,
                'end_date' => $endDate
            ]
        ];
        return view('frontend.schedule.index', $data);
    }
     public function build_schedule(Request $request)
{
    
    $for_schedule = $request->input('for_schedule', []);
    
    $data = [
        'address' => $for_schedule['address'] ?? '',
        'start_date' => $for_schedule['start_date'] ?? '',
        'end_date' => $for_schedule['end_date'] ?? '',
        'placeName' => $for_schedule['placeNames'] ?? '',
        'budget' => $for_schedule['budget'] ?? '',
        'currency' => $for_schedule['currency'] ?? '',
        'adults' => $for_schedule['adults'] ?? 0,
        'children_1' => $for_schedule['children_1'] ?? 0,
        'children_2' => $for_schedule['children_2'] ?? 0,
        'transportation' => $for_schedule['transportation'] ?? '',
        'interest' => $for_schedule['interest'] ?? [],
    ];

    $currencies = Currency::query()->get();
    $preferences = Preference::query()->get();

    $plans = $this->geminiService->generateItinerary($data);

    if (!$plans || !is_array($plans)) {
    \Log::error('Không tạo được plans', ['plans' => $plans, 'data' => $data]);
    return response()->json(['error' => 'Không tạo được lịch trình'], 500);
    }
    $wikicontent = [];


      session([
        'plans' => $plans,
        'start_date' => $for_schedule['start_date'] ?? '',
    ]);
    return view('frontend.schedule.ajax.schedule-built', compact('plans', 'currencies', 'preferences', 'wikicontent'));
}
    public function getToaDo($location){

    }

    public function cacheAllLocations($locations)
    {
        $locations = [
            'diem_1',
            'diem_2',
            'diem_3',
            'diem_4',
        ];

        $client = Http::withOptions(['synchronous' => false])->getClient();

        $promises = [];
        foreach ($locations as $id) {
            $promises[$id] = $client->getAsync("https://api.example.com/coords/{$id}");
        }

        $results = Promise\settle($promises)->wait();

        foreach ($results as $id => $response) {
            if ($response['state'] === 'fulfilled') {
                $data = json_decode($response['value']->getBody(), true);
                Cache::put("coords_{$id}", $data, now()->addHours(12)); // cache 12h
            }
        }

        return response()->json(['message' => 'Cached successfully']);
    }


    public function getEventAndActivity(Request $request)
    {
        $address = $request->input('address');
        $data = [
            'address' => $address['address'],
            'start_date' => $address['start_date'],
            'end_date' => $address['end_date']
        ];



        $activities = $this->geminiService->getEvent($data);
        return view('frontend.schedule.ajax.eventAndActivity', compact('activities'));

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
