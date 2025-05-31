<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class WikipediaService
{
    /**
     * Search Wikipedia and get the first result's summary and thumbnail.
     *
     * @param string $query
     * @return array|null
     */
    public function getPlaceInfo($query)
    {
        // 1. Search for the query
        $searchUrl = "https://vi.wikipedia.org/w/api.php";
        $searchResponse = Http::withOptions(['verify' => false])->get($searchUrl, [
            'action' => 'query',
            'list' => 'search',
            'srsearch' => $query,
            'format' => 'json',
         
        ]);
    
        if (!$searchResponse->successful() || empty($searchResponse['query']['search'])) {
            return null;
        }
    
        $firstTitle = $searchResponse['query']['search'][0]['title'];
        
        // 2. Get summary and thumbnail for the first result
        $summaryUrl = "https://vi.wikipedia.org/api/rest_v1/page/summary/" .($firstTitle);
        $summaryResponse = Http::withOptions(['verify' => false])->get($summaryUrl);
        
       

        $data = $summaryResponse->json();

        // Try to get the image from summary
        $image = $data['thumbnail']['source'] ?? null;

        // If no image, try to get the main image from the images API
        if (!$image) {
            $imageApiUrl = "https://vi.wikipedia.org/w/api.php";
            $imageResponse = Http::withOptions(['verify' => false])->get($imageApiUrl, [
                'action' => 'query',
                'prop' => 'pageimages',
                'titles' => $firstTitle,
                'format' => 'json',
                'pithumbsize' => 400,
            ]);
            if ($imageResponse->successful()) {
                $imageData = $imageResponse->json();
                if (!empty($imageData['query']['pages'])) {
                    $page = array_values($imageData['query']['pages'])[0];
                    if (isset($page['thumbnail']['source'])) {
                        $image = $page['thumbnail']['source'];
                    }
                }
            }
        }
        // Try to get the full content of the page
        $fullContent = null;
        $contentApiUrl = "https://vi.wikipedia.org/w/api.php";
        $contentResponse = Http::withOptions(['verify' => false])->get($contentApiUrl, [
            'action' => 'query',
            'prop' => 'extracts',
            'explaintext' => true,
            'titles' => $firstTitle,
            'format' => 'json',
            'redirects' => 1,
        ]);
        if ($contentResponse->successful()) {
            $contentData = $contentResponse->json();
            if (!empty($contentData['query']['pages'])) {
            $page = array_values($contentData['query']['pages'])[0];
            if (isset($page['extract'])) {
                $fullContent = $page['extract'];
            }
            }
        }
        return [
            'title' => $data['title'] ?? $firstTitle,
            'summary' => $data['extract'] ?? '',
            'image' => $data['thumbnail']['source'] ?? $image,
            'url' => $data['content_urls']['desktop']['page'] ?? null,
            'fullcontent' => $fullContent ?: '',
        ];
    }
}