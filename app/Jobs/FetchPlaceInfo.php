<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

class FetchPlaceInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $place;

    public function __construct(string $place)
    {
        $this->place = $place;
    }

    /**
     * Prevent duplicate jobs from being queued or run simultaneously.
     */
 

    public function handle(): void
    {

        $lockKey = 'place_info_lock_' . md5($this->place);
        try {
            $client = new Client();
            $response = $client->get(env('MAP_SCRAPER_LINK'), [
                'query' => ['place' => $this->place]
            ]);
            $data = json_decode($response->getBody()->getContents(), true);

            Cache::put("place_info_{$this->place}", $data, now()->addMinutes(10));
        } finally {
            Cache::lock($lockKey)->release();
        }
    }
}
