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

    public function showRoute(Request $request)
    {
        $origin = $request->input('origin', '21.0285,105.8522'); // Mặc định Hồ Hoàn Kiếm
        $destination = $request->input('destination', '21.0367,105.8347'); // Mặc định Lăng Bác
        $mode = $request->input('mode', 'car');

        // Gọi phương thức getRoute từ Map4DService
        $routeData = $this->map4DService->getRoute($origin, $destination, $mode);

        if (!$routeData) {
            // Xử lý khi không lấy được dữ liệu (API lỗi, ...)
            // Ví dụ: quay lại trang trước với thông báo lỗi
            return back()->with('error', 'Không thể tìm thấy đường đi. Vui lòng thử lại.');
        }

        // Nếu thành công, truyền dữ liệu routeData sang View
        // $routeData bây giờ chứa thông tin JSON từ API (vd: các đoạn đường, thời gian, khoảng cách)
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
        print_r($currencies);
        print_r($preferences);
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
        $address_old = $request->input('address');
        $address = str_replace(['Tỉnh ', 'Thành phố '], '', $address_old);
        $map = null;
        $error = null;

        $endpoint = 'weather';
        $params = [
            'query' => $address,
        ];

//        $map = $this->rapidApiService->fetchData($params);
//        $address = "Chùa minh thành";
        if ($address) {
            $result = $this->map4DService->geocode($address);

            if (!$result || empty($result)) {
                $error = 'Không tìm thấy địa điểm.';
            } else {
                $map = $result[0];
            }
        }
        if (!empty($map)) {
            $lat = $map['lat'];
            $lon = $map['lon'];
        } else {
            $lat = 10.8206;
            $lon = 106.6281;
        }

//        print_r($lat);
//        dd($lon);

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
        $placeNames = array_keys($places);

        $placeNames = implode(", ", $placeNames);

        $preferences = Preference::query()->get();
        $address = convertVietnameseToLatin($address);

        $params = $request->query();
        $query = http_build_query($params);
        $finalUrl = url('/build-schedule') . '?' . $query;


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
        $placeNames = $request->input('placeNames');
//        dd($request->all());
        $data = [
            'address' => $placeNames['address'],
            'start_date' => $placeNames['start_date'],
            'end_date' => $placeNames['end_date'],
            'placeName' => $placeNames['placeNames'],
            'budget' => $placeNames['budget'],
            'currency' => $placeNames['currency'],
            'adults' => $placeNames['adults'],
            'children_1' => $placeNames['children_1'],
            'children_2' => $placeNames['children_2'],
            'transportation' => $placeNames['transportation'],
            'interest' => $placeNames['interest'],
        ];



        $currencies = Currency::query()->get();
        $preferences = Preference::query()->get();

        $plans = $this->geminiService->generateItinerary($data);

        foreach ($plans as $day => &$dailyPlan) {
            foreach ($dailyPlan as $partOfDay => &$activities) {
                if (is_array($activities)) {
                    foreach ($activities as &$activity) {
                        if (isset($activity['type']) && isset($activity['details'])) {
                            $type = $activity['type'];

                            if (in_array($type, ['Ăn sáng', 'Ăn trưa', 'Ăn tối', 'Chỗ ngủ'])) {
                                if (is_string($activity['details'])) {
                                    $activity['details'] = cleanLocationString($activity['details']);
                                }
                            } elseif ($type === 'Di chuyển') {
                                if (is_array($activity['details'])) {
                                    if (isset($activity['details']['Điểm đi']) && is_string($activity['details']['Điểm đi'])) {
                                        $activity['details']['Điểm đi'] = cleanLocationString($activity['details']['Điểm đi']);
                                    }
                                    if (isset($activity['details']['Điểm đến']) && is_string($activity['details']['Điểm đến'])) {
                                        $activity['details']['Điểm đến'] = cleanLocationString($activity['details']['Điểm đến']);
                                    }
                                }
                            } elseif ($type === 'Địa điểm tham quan') {
                                if (is_array($activity['details'])) {
                                    if (isset($activity['details']['Tên địa điểm']) && is_string($activity['details']['Tên địa điểm'])) {
                                        $activity['details']['Tên địa điểm'] = cleanLocationString($activity['details']['Tên địa điểm']);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        foreach ($plans as $day => &$activities){
            foreach ($activities as &$session_key){
                foreach ($session_key as &$session_active){
                    $type = $session_active['type'];
                    if($type == 'Di chuyển'){
                        $from = str_replace(" (tự tìm)", "", $session_active['details']['Điểm đi']);
                        $to = str_replace(" (tự tìm)", "", $session_active['details']['Điểm đến']);
                        $origin = $this->map4DService->geocode($from);
                        $destination = $this->map4DService->geocode($to);
                        $session_active['details']['origin_lat'] = $origin[0]['lat'] ?? '';
                        $session_active['details']['origin_lon'] = $origin[0]['lon'] ?? '';
                        $session_active['details']['destination_lat'] = $destination[0]['lat'] ?? '';
                        $session_active['details']['destination_lon'] = $destination[0]['lon'] ?? '';
                    }
                }
            }
        }


        return view('frontend.schedule.ajax.schedule-built', compact('plans', 'currencies', 'preferences'));

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
//        print_r($request->all());
        $address = $request->input('address');
//        dd($address);
        $data = [
            'address' => $address['address'],
            'start_date' => $address['start_date'],
            'end_date' => $address['end_date']
        ];

//        dd($data);

//        $currencies = Currency::query()->get();
//        $preferences = Preference::query()->get();

        $activities = $this->geminiService->getEvent($data);
//        dd($activities);
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
