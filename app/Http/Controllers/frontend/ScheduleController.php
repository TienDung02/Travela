<?php

namespace App\Http\Controllers\frontend;
use App\Models\Preference;
use App\Services\ProvinceService;
use App\Services\MapAPIService;
use App\Services\WeatherService;
use App\Services\GeminiService;
use App\Services\WikipediaService;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\Helper;
class ScheduleController
{
    protected $goMapsService;
    protected $weatherService;
    protected $provinceService;
    protected $geminiService;
    protected $wikipediaService;


    public function __construct(MapAPIService $goMapsService, ProvinceService $provinceService, WeatherService $weatherService, GeminiService $geminiService, WikipediaService $wikipediaService)
    {
        $this->goMapsService = $goMapsService;
        $this->provinceService = $provinceService;
        $this->weatherService = $weatherService;
        $this->geminiService = $geminiService;
        $this->wikipediaService = $wikipediaService;

    }
    public function index()
    {
        $currencies = Currency::query()->get();
        $preferences = Preference::query()->get();
        return view('frontend.schedule.index', compact('currencies', 'preferences'));
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
        $address = str_replace(['Tỉnh ', 'Thành phố '], '', $address);
        $data = null;
        $error = null;

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
//        print_r($lon);
//        print_r($lat);die;

        $currencies = Currency::query()->get();
        $weather = $this->weatherService->getWeatherByCity($address);

        if (!$weather) {
            return view('frontend.weather', [
                'error' => "Không thể lấy thông tin thời tiết của thành phố: {$address}. Vui lòng thử lại!"
            ]);
        }



        $budget = floatval($request->input('budget', 0));
        $currencyCode = $request->input('currency', 'VND'); // Mặc định VND
        // 🔹 Gửi dữ liệu này đến AI để tạo lịch trình
        $preferences = $request->input('interest');
//        dd($preferences);
        // 🔹 Lấy ngày đi & ngày về
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $days = 3; // Mặc định nếu không nhập ngày
        if ($startDate && $endDate) {
            $days = (new \DateTime($startDate))->diff(new \DateTime($endDate))->days;
        }

        $adults = $request->input('adults');
        $children_1 = $request->input('children-1');
        $children_2 = $request->input('children-2');
        $transportation = $request->input('transportation');


        $interest = $request->input('interest');
        $interest = implode(', ', $interest);

        $places = $this->geminiService->getTourismInfo($address, $preferences);
        $placeNames = array_keys($places);
//        print_r($places);
        $placeNames = implode(", ", $placeNames);

//        dd($places, $placeNames);


        // Gửi ngân sách và đơn vị tiền tệ cho AI
        $plans = $this->geminiService->generateItinerary($address, $days, $startDate, $endDate, $budget, $currencyCode, $interest, $adults, $children_1, $children_2, $placeNames, $transportation);

//        dd($plan);
        $preferences = Preference::query()->get();

        $address = convertVietnameseToLatin($address);

        return view('frontend.schedule.index', compact('data', 'currencies', 'weather', 'error' , 'preferences', 'lat', 'lon', 'address', 'places', 'plans'));
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
