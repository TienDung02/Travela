<?php

namespace App\Http\Controllers\frontend;

use App\Services\GoMapsService;
use Illuminate\Http\Request;
use App\Services\GeoNamesService;
class GoMapsController
{
    protected $goMapsService;
    protected $geoNamesService;


    public function __construct(GoMapsService $goMapsService,GeoNamesService $geoNamesService)
    {
        $this->goMapsService = $goMapsService;
        $this->geoNamesService = $geoNamesService;

    }

    public function map2(Request $request)
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

        return view('frontend.geocode', compact('data', 'error'));
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
        $query = $request->input('q', 'hanoi');
        $results = $this->geoNamesService->searchLocation($query);

        return response()->json($results);
    }
    public function index()
    {
        return view('frontend.search');
    }

}




