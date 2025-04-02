<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RapidApiService
{
    protected $apiKey;
    protected $apiHost;

    public function __construct()
    {
        $this->apiKey = env('RAPIDAPI_KEY');
        $this->apiHost = env('RAPIDAPI_HOST');
    }

    public function fetchData($endpoint, $params = [])
    {
        $response = Http::withHeaders([
            'X-RapidAPI-Key' => $this->apiKey,
            'X-RapidAPI-Host' => $this->apiHost,
        ])->get("https://{$this->apiHost}/", $params);

        return $response->json();
    }
}
