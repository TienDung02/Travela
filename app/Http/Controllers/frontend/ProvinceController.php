<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Services\ProvinceService;

class ProvinceController
{
    protected $provinceService;

    public function __construct(ProvinceService $provinceService)
    {
        $this->provinceService = $provinceService;
    }

    public function getProvinces()
    {
        return response()->json($this->provinceService->getProvinces());
    }

    public function getDistricts($provinceId)
    {
        return response()->json($this->provinceService->getDistricts($provinceId));
    }

    public function getWards($districtId)
    {
        return response()->json($this->provinceService->getWards($districtId));
    }

    public function search(Request $request)
    {
        $query = $request->query('q');
        if (!$query) {
            return response()->json([]);
        }

        return response()->json($this->provinceService->searchLocations($query));
    }

}
