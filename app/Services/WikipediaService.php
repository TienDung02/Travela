<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WikipediaService
{
    public function getPlaceInfo($query)
    {
        // 1. Search Wikipedia for the page and get Wikidata entity ID
        $searchUrl = "https://vi.wikipedia.org/w/api.php";
        $searchResponse = \Illuminate\Support\Facades\Http::withOptions(['verify' => false])->get($searchUrl, [
            'action' => 'query',
            'list' => 'search',
            'srsearch' => $query,
            'format' => 'json',
        ]);

        if (!$searchResponse->successful() || empty($searchResponse['query']['search'])) {
            return null;
        }

        $firstTitle = $searchResponse['query']['search'][0]['title'];

        // Get page info to find Wikidata entity ID
        $pageInfoUrl = "https://vi.wikipedia.org/w/api.php";
        $pageInfoResponse = \Illuminate\Support\Facades\Http::withOptions(['verify' => false])->get($pageInfoUrl, [
            'action' => 'query',
            'prop' => 'pageprops',
            'titles' => $firstTitle,
            'format' => 'json',
        ]);
        $pageInfo = $pageInfoResponse->json();
        $pages = $pageInfo['query']['pages'];
        $wikidataId = null;
        foreach ($pages as $page) {
            if (isset($page['pageprops']['wikibase_item'])) {
                $wikidataId = $page['pageprops']['wikibase_item'];
                break;
            }
        }
        if (!$wikidataId) {
            return null;
        }

        // 2. Fetch data from Wikidata
        $wikidataUrl = "https://www.wikidata.org/w/api.php";
        $wikidataResponse = \Illuminate\Support\Facades\Http::withOptions(['verify' => false])->get($wikidataUrl, [
            'action' => 'wbgetentities',
            'ids' => $wikidataId,
            'format' => 'json',
            'props' => 'labels|descriptions|sitelinks|claims',
            'languages' => 'vi|en',
        ]);
        $wikidata = $wikidataResponse->json();
        $entity = $wikidata['entities'][$wikidataId] ?? null;
        if (!$entity) {
            return null;
        }

        // Title and summary
        $summary = '';
        $title = $entity['labels']['vi']['value'] ?? $entity['labels']['en']['value'] ?? $firstTitle;
        $desc = $entity['descriptions']['vi']['value'] ?? $entity['descriptions']['en']['value'] ?? '';

        // Use Wikipedia summary API for a better summary
        $summaryApiUrl = "https://vi.wikipedia.org/api/rest_v1/page/summary/" . ($firstTitle);
        $summaryApiResponse = \Illuminate\Support\Facades\Http::withOptions(['verify' => false])->get($summaryApiUrl);
        if ($summaryApiResponse->successful() && isset($summaryApiResponse['extract'])) {
            $summary = $summaryApiResponse['extract'];
        }

        // Wikipedia URL
        $url = null;
        if (isset($entity['sitelinks']['viwiki']['url'])) {
            $url = $entity['sitelinks']['viwiki']['url'];
        } elseif (isset($entity['sitelinks']['enwiki']['url'])) {
            $url = $entity['sitelinks']['enwiki']['url'];
        }

        // Coordinates (P625)
        $lat = $lon = null;
        if (isset($entity['claims']['P625'][0]['mainsnak']['datavalue']['value'])) {
            $coords = $entity['claims']['P625'][0]['mainsnak']['datavalue']['value'];
            $lat = $coords['latitude'] ?? null;
            $lon = $coords['longitude'] ?? null;
        }

        // Main image (P18)
        $image = null;
        if (isset($entity['claims']['P18'][0]['mainsnak']['datavalue']['value'])) {
            $imageName = $entity['claims']['P18'][0]['mainsnak']['datavalue']['value'];
            $commonsName = str_replace(' ', '_', $imageName);
            $md5 = md5($commonsName);
            $image = "https://upload.wikimedia.org/wikipedia/commons/{$md5[0]}/{$md5[0]}{$md5[1]}/{$commonsName}";
        }
        // If no main image or the image URL is not valid, try to use wiki thumbnail
        if (
            empty($image) ||
            !filter_var($image, FILTER_VALIDATE_URL)
        ) {
            // Get image from Wikipedia summary API (better for thumbnails)
            if ($summaryApiResponse->successful() && isset($summaryApiResponse['thumbnail']['source'])) {
                $image = $summaryApiResponse['thumbnail']['source'];
            } else {
                $image = null;
            }
        }
       

        // Night view (P3451)
        $nightViewImage = null;
        if (isset($entity['claims']['P3451'][0]['mainsnak']['datavalue']['value'])) {
            $nightViewName = $entity['claims']['P3451'][0]['mainsnak']['datavalue']['value'];
            $nightViewCommons = str_replace(' ', '_', $nightViewName);
            $nightViewMd5 = md5($nightViewCommons);
            $nightViewImage = "https://upload.wikimedia.org/wikipedia/commons/{$nightViewMd5[0]}/{$nightViewMd5[0]}{$nightViewMd5[1]}/{$nightViewCommons}";
        }

        // Population (P1082)
        $population = null;
        if (isset($entity['claims']['P1082'][0]['mainsnak']['datavalue']['value']['amount'])) {
            $population = $entity['claims']['P1082'][0]['mainsnak']['datavalue']['value']['amount'];
        }

        // Length (P2043)
        $length = null;
        if (isset($entity['claims']['P2043'][0]['mainsnak']['datavalue']['value']['amount'])) {
            $length = $entity['claims']['P2043'][0]['mainsnak']['datavalue']['value']['amount'];
        }

        // Width (P2049)
        $width = null;
        if (isset($entity['claims']['P2049'][0]['mainsnak']['datavalue']['value']['amount'])) {
            $width = $entity['claims']['P2049'][0]['mainsnak']['datavalue']['value']['amount'];
        }

        // Depth (P4011)
        $depth = null;
        if (isset($entity['claims']['P4011'][0]['mainsnak']['datavalue']['value']['amount'])) {
            $depth = $entity['claims']['P4011'][0]['mainsnak']['datavalue']['value']['amount'];
        }

        // Area (P2046)
        $area = null;
        if (isset($entity['claims']['P2046'][0]['mainsnak']['datavalue']['value']['amount'])) {
            $area = $entity['claims']['P2046'][0]['mainsnak']['datavalue']['value']['amount'];
        }

        return [
            'title' => $title,
            'description' => $desc,
            'summary' => $summary,
            'image' => $image,
            'url' => $url,
            'coordinates' => [
                'lat' => $lat,
                'lon' => $lon,
            ],
            'population' => $population,
            'length' => $length,
            'width' => $width,
            'depth' => $depth,
            'area' => $area,
            'night_view_image' => $nightViewImage,
        ];
    }
}