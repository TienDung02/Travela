<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeoNamesService
{
    protected $baseUrl;
    protected $username;

    public function __construct()
    {
        $this->baseUrl = config('services.geonames.base_url');
        $this->username = config('services.geonames.username');
    }

    public function searchLocation($query, $maxRows = 10)
    {
        if (!$query) {
            return ['error' => 'Missing query'];
        }

        $response = Http::get("{$this->baseUrl}searchJSON", [
            'q' => $query,
            'maxRows' => $maxRows,
            'featureClass' => 'P',
            'username' => $this->username,
        ]);

        return $response->json();
    }
}
