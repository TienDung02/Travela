<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ProvinceService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.province_api');
    }

    public function getProvinces()
    {
        $response = Http::get("{$this->baseUrl}p/");
        return $response->json();
    }

    public function getDistricts($provinceId)
    {
        $response = Http::get("{$this->baseUrl}p/{$provinceId}?depth=2");
        return $response->json();
    }

    public function getWards($districtId)
    {
        $response = Http::get("{$this->baseUrl}d/{$districtId}?depth=2");
        return $response->json();
    }

    public function searchLocations($query)
    {
        $provinces = collect($this->getProvinces())->filter(function ($province) use ($query) {
            return stripos($province['name'], $query) === 0;
        });
        return $provinces->values()->all();
    }


}
