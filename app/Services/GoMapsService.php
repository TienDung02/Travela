<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class GoMapsService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = "https://maps.gomaps.pro/maps/api";
        $this->client = new Client();
        $this->apiKey = env('GOMAPS_API_KEY'); // Lấy API Key từ .env
    }
    public function getDirections($origin, $destination)
    {
        $response = Http::get("{$this->baseUrl}/directions/json", [
            'origin' => $origin,
            'destination' => $destination,
            'key' => $this->apiKey
        ]);

        return $response->json();
    }
    public function geocode($address)
    {
        $response = Http::get("{$this->baseUrl}/geocode/json", [
            'address' => $address,
            'key' => $this->apiKey
        ]);
        return $response->json();
    }

    public function reverseGeocode($lat, $lng)
    {
        $url = "https://api.gomaps.pro/reverse?lat={$lat}&lng={$lng}&key=" . $this->apiKey;

        $response = $this->client->get($url);
        return json_decode($response->getBody()->getContents(), true);
    }
}
