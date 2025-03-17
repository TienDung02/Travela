<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WikipediaService
{
    public function getPlaceImage($placeName)
    {
        $url = "https://en.wikipedia.org/api/rest_v1/page/summary/" . urlencode($placeName);

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data["thumbnail"]["source"])) {
                return response()->json(["image" => $data["thumbnail"]["source"]]);
            } else {
                return response()->json(["error" => "Không tìm thấy hình ảnh"], 404);
            }
        }

        return response()->json(["error" => "Không thể kết nối đến Wikipedia"], 500);
    }

}
