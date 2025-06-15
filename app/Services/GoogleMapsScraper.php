<?php
namespace App\Services;

use App\Jobs\FetchPlaceInfo;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
class GoogleMapsScraper
{
    private $apilink;

    public function __construct()
    {
        $this->apilink = env('MAP_SCRAPER_LINK');
    }

    public function queuePlaceInfo(string $name): void
    {
        $lockKey = 'place_info_lock_' . md5($name);
        if (Cache::lock($lockKey, 300)->get()) {
            // Lock acquired — dispatch job and it will release lock when finished
            dispatch(new FetchPlaceInfo($name));
        } else {
            // Job already running or in queue
            logger("Skipping duplicate job for: $name");
        }
    }

    public function getPlaceInfo(string $name): ?array
    {
        $client = new Client();
        $response = $client->get(env('MAP_SCRAPER_LINK'), [
            'query' => ['place' => $name]
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        return [
            'title'     => $data['title'] ?? $name,
            'info'      => $data['info'] ?? null,
            'rating'    => $data['rating'] ?? null,
            'category'  => $data['category'] ?? null,
            'reviews'   => array_slice($data['reviews'] ?? [], 0, 5),
            'thumbnail' => $data['images'][0] ?? null,
            'images'    => array_slice($data['images'] ?? [], 0, 5),
        ];
    }

    public function getCachedPlaceInfo(string $name): ?array
    {
        $data = Cache::get("place_info_{$name}");
        if (!$data) return null;

        return [
            'title'     => $data['title'] ?? $name,
            'info'      => $data['info'] ?? null,
            'rating'    => $data['rating'] ?? null,
            'category'  => $data['category'] ?? null,
            'reviews'   => array_slice($data['reviews'] ?? [], 0, 5),
            'thumbnail' => $data['images'][0] ?? null,
            'images'    => array_slice($data['images'] ?? [], 0, 5),
        ];
    }
}

