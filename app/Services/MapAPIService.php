<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MapAPIService
{
    protected $nominatimUrl;
    protected $osrmUrl;

    public function __construct()
    {
        $this->nominatimUrl = "https://nominatim.openstreetmap.org";
        $this->osrmUrl = "https://router.project-osrm.org/route/v1";
    }

    /**
     * Lấy tọa độ từ tên địa điểm (Geocoding)
     */
    public function geocode($address)
    {

        $response = Http::withHeaders([
            'User-Agent' => 'YourAppName/1.0 (nongtiendugn2309@gmail.com)'
        ])->get("https://nominatim.openstreetmap.org/search", [
            'q' => $address,
            'format' => 'json'
        ]);

        return $response->json();
    }


    /**
     * Lấy tên địa điểm từ tọa độ (Reverse Geocoding)
     */
    public function reverseGeocode($lat, $lon)
    {
        $response = Http::get("{$this->nominatimUrl}/reverse", [
            'lat' => $lat,
            'lon' => $lon,
            'format' => 'json'
        ]);

        return $response->json();
    }

    /**
     * Lấy chỉ đường giữa hai địa điểm (Routing)
     */
    public function getDirections($originLat, $originLon, $destinationLat, $destinationLon)
    {
        $response = Http::get("{$this->osrmUrl}/driving/{$originLon},{$originLat};{$destinationLon},{$destinationLat}", [
            'overview' => 'full'
        ]);

        return $response->json();
    }



}
