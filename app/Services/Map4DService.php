<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http; // Sử dụng Laravel HTTP Client
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Client\RequestException; // Để bắt lỗi HTTP
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
class Map4DService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        // Lấy key và url từ file config/services.php
        $this->apiKey = Config::get('services.map4d.key');
        $this->baseUrl = Config::get('services.map4d.base_url');

        if (!$this->apiKey) {
            // Có thể throw exception hoặc log lỗi nếu không có API key
            throw new \Exception('Map4D API Key not configured.');
        }
    }

    /**
     * Gọi API tìm đường (Route) của Map4D.
     *
     * @param string $origin Tọa độ điểm bắt đầu (vd: "21.0285,105.8522")
     * @param string $destination Tọa độ điểm kết thúc (vd: "21.0367,105.8347")
     * @param string $mode Phương tiện ('car', 'motorcycle', 'foot', 'bike')
     * @param array $options Các tham số tùy chọn khác (vd: language, points, avoid, ...)
     * @return array|null Dữ liệu JSON trả về từ API hoặc null nếu lỗi
     */
    public function getRoute(string $origin, string $destination, string $mode = 'car', array $options = []): ?array
    {
        // Xây dựng các tham số query
        $queryParams = array_merge([
            'key' => $this->apiKey,
            'origin' => $origin,
            'destination' => $destination,
            'mode' => $mode,
            'language' => 'vi', // Mặc định tiếng Việt
        ], $options); // Gộp các options tùy chọn vào

        try {
            $response = Http::baseUrl($this->baseUrl) // Đặt Base URL
            ->get('/route', $queryParams); // Gọi tới endpoint /route

            $response->throw(); // Ném exception nếu có lỗi HTTP (4xx, 5xx)

            return $response->json(); // Trả về dữ liệu JSON

        } catch (RequestException $e) {
            // Log lỗi hoặc xử lý lỗi cụ thể
            logger()->error('Map4D API Error (Route): ' . $e->getMessage(), [
                'url' => $this->baseUrl . '/route',
                'params' => $queryParams, // Không log API key ở production
                'status' => $e->response->status() ?? 'N/A',
                'response_body' => $e->response->body() ?? 'N/A'
            ]);
            return null; // Trả về null khi có lỗi
        } catch (\Exception $e) {
            logger()->error('Map4D Service Error (Route): ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Gọi API Geocoding của Map4D (ví dụ chuyển địa chỉ thành tọa độ).
     *
     * @param string $address Địa chỉ cần tìm kiếm
     * @return array|null Dữ liệu JSON trả về từ API hoặc null nếu lỗi
     */
//    public function geocode(string $address): ?array
//    {
//        $queryParams = [
//            'key' => $this->apiKey,
//            'address' => $address,
//        ];
//
//        try {
//            $response = Http::baseUrl($this->baseUrl)
//                ->get('/geocode', $queryParams);
//
//            $response->throw();
//            dd($response->json());
//
//            return $response->json();
//
//        } catch (RequestException $e) {
//            logger()->error('Map4D API Error (Geocode): ' . $e->getMessage(), [
//                'url' => $this->baseUrl . '/geocode',
//                'params' => ['address' => $address],
//                'status' => $e->response->status() ?? 'N/A',
//                'response_body' => $e->response->body() ?? 'N/A'
//            ]);
//            return null;
//        } catch (\Exception $e) {
//            logger()->error('Map4D Service Error (Geocode): ' . $e->getMessage());
//            return null;
//        }
//    }

    public function geocode($address)
    {

        $cacheKey = 'geo_' . md5($address);

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        if (empty($this->apiKey)) {
            Log::warning("Không thể geocode địa chỉ '{$address}': MAP4D_API_KEY không có.");
            return null;
        }

        try {
            $response = Http::get('https://api.map4d.vn/sdk/place/text-search', [
                'key'  => $this->apiKey,
                'text' => $address,
            ]);

            if (!$response->successful()) {
                Log::error("Map4D API request failed for address '{$address}'. Status: {$response->status()}, Response: {$response->body()}");
                return null;
            }

            $responseData = $response->json();

            if (is_array($responseData['result']) && !empty($responseData['result'])) {

                $result = [
                    'lat' => (float) $responseData['result'][0]['location']['lat'],
                    'lon' => (float) $responseData['result'][0]['location']['lng'],
                    'raw' => $responseData['result'][0]
                ];

                Cache::put($cacheKey, $result, now()->addHours(12));
                return $result;
            } else {
                Log::warning("Map4D API did not return expected data for address '{$address}'. Response: " . json_encode($responseData));
                return null;
            }


        } catch (\Exception $e) {
            Log::error("Exception during geocoding for address '{$address}': " . $e->getMessage());
            return null;
        }
    }
    public function geocode2($address)
    {
        $cacheKey = 'geo_' . md5($address);
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        if (empty($this->apiKey)) {
            Log::warning("Không thể geocode địa chỉ '{$address}': MAP4D_API_KEY không có.");
            return null;
        }
        try {
            $response = Http::get('https://api.map4d.vn/sdk/place/text-search', [
                'key'  => $this->apiKey,
                'text' => $address,
            ]);
            if (!$response->successful()) {
                return null;
            }
            $responseData = $response->json();
            if (is_array($responseData['result']) && !empty($responseData['result'])) {

                $result = [
                    'lat' => (float) $responseData['result'][0]['location']['lat'],
                    'lon' => (float) $responseData['result'][0]['location']['lng'],
                    'raw' => $responseData['result'][0]
                ];

                Cache::put($cacheKey, $result, now()->addHours(12));

                return $result;
            } else {
                Log::warning("Map4D API did not return expected data for address '{$address}'. Response: " . json_encode($responseData));
                return null;
            }


        } catch (\Exception $e) {
            Log::error("Exception during geocoding for address '{$address}': " . $e->getMessage());
            return null;
        }
    }

}
