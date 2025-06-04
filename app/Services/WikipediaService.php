<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WikipediaService
{
    public function getPlaceInfo($query)
    {
        // 1. Search Wikipedia for the page and get Wikidata entity ID
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

        // Get page info to find Wikidata entity ID
        $pageInfoUrl = "https://vi.wikipedia.org/w/api.php";
        $pageInfoResponse = Http::withOptions(['verify' => false])->get($pageInfoUrl, [
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
        $wikidataResponse = Http::withOptions(['verify' => false])->get($wikidataUrl, [
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
        $title = $entity['labels']['vi']['value'] ?? $entity['labels']['en']['value'] ?? $firstTitle;
        $summary = $entity['descriptions']['vi']['value'] ?? $entity['descriptions']['en']['value'] ?? '';

        // Wikipedia URL
        $url = null;
        if (isset($entity['sitelinks']['viwiki']['url'])) {
            $url = $entity['sitelinks']['viwiki']['url'];
        } elseif (isset($entity['sitelinks']['enwiki']['url'])) {
            $url = $entity['sitelinks']['enwiki']['url'];
        }
       
$fullContent = '
<div class="card border-0 shadow-sm mb-0">
  <div class="card-body pb-0">
    <h4 class="card-title text-primary mb-2">' . e($title) . '</h4>
    <p class="card-text mb-3">' . e($summary) . '</p>
    <ul class="list-group list-group-flush mb-3">';

// Coordinates (P625) with map inside the list-group-item
$lat = $lon = null;
if (isset($entity['claims']['P625'][0]['mainsnak']['datavalue']['value'])) {
    $coords = $entity['claims']['P625'][0]['mainsnak']['datavalue']['value'];
    $lat = $coords['latitude'] ?? '';
    $lon = $coords['longitude'] ?? '';
    $fullContent .= '<li class="list-group-item">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="fw-semibold">Tọa độ:</span>
            <span>' . e($lat) . ', ' . e($lon) . '</span>
        </div>';
    if ($lat && $lon) {
        $fullContent .= '
        <div class="text-center">
          <iframe width="100%" height="200" frameborder="0" style="border:1px solid #ccc;border-radius:8px;" 
            src="https://www.openstreetmap.org/export/embed.html?bbox=' . ($lon-0.01) . '%2C' . ($lat-0.01) . '%2C' . ($lon+0.01) . '%2C' . ($lat+0.01) . '&amp;layer=mapnik&amp;marker=' . $lat . ',' . $lon . '" allowfullscreen></iframe>
          <div class="small mt-1">
            <a href="https://www.openstreetmap.org/?mlat=' . $lat . '&amp;mlon=' . $lon . '" target="_blank" rel="noopener">Xem bản đồ lớn hơn</a>
          </div>
        </div>';
    }
    $fullContent .= '</li>';
}

//P18 image
if (isset($entity['claims']['P18'][0]['mainsnak']['datavalue']['value'])) {
    $imageName = $entity['claims']['P18'][0]['mainsnak']['datavalue']['value'];
    // Wikimedia Commons image URL format
    $commonsName = str_replace(' ', '_', $imageName);
    $md5 = md5($commonsName);
    $imageUrl = "https://upload.wikimedia.org/wikipedia/commons/{$md5[0]}/{$md5[0]}{$md5[1]}/{$commonsName}";
    $fullContent .= '<li class="list-group-item">
        <span class="fw-semibold d-block mb-1">Hình ảnh:</span>
        <img src="' . e($imageUrl) . '" alt="' . e($title) . '" class="rounded shadow w-100 h-auto border border-secondary">
    </li>';
}
// Population (P1082)
if (isset($entity['claims']['P1082'][0]['mainsnak']['datavalue']['value']['amount'])) {
    $population = $entity['claims']['P1082'][0]['mainsnak']['datavalue']['value']['amount'];
    $fullContent .= '<li class="list-group-item d-flex justify-content-between align-items-center"><span class="fw-semibold">Dân số:</span> <span>' . e($population) . '</span></li>';
}
// Lenghth (P2043)
if (isset($entity['claims']['P2043'][0]['mainsnak']['datavalue']['value']['amount'])) {
    $length = $entity['claims']['P2043'][0]['mainsnak']['datavalue']['value']['amount'];
    $fullContent .= '<li class="list-group-item d-flex justify-content-between align-items-center"><span class="fw-semibold">Chiều dài:</span> <span>' . e($length) . ' km</span></li>';
}

// Width (2049)
if (isset($entity['claims']['P2049'][0]['mainsnak']['datavalue']['value']['amount'])) {
    $width = $entity['claims']['P2049'][0]['mainsnak']['datavalue']['value']['amount'];
    $fullContent .= '<li class="list-group-item d-flex justify-content-between align-items-center"><span class="fw-semibold">Chiều rộng:</span> <span>' . e($width) . ' km</span></li>';
}

// Depth (P4011)
if (isset($entity['claims']['P4011'][0]['mainsnak']['datavalue']['value']['amount'])) {
    $depth = $entity['claims']['P4011'][0]['mainsnak']['datavalue']['value']['amount'];
    $fullContent .= '<li class="list-group-item d-flex justify-content-between align-items-center"><span class="fw-semibold">Độ sâu:</span> <span>' . e($depth) . ' m</span></li>';
}


// Area (P2046)
if (isset($entity['claims']['P2046'][0]['mainsnak']['datavalue']['value']['amount'])) {
    $area = $entity['claims']['P2046'][0]['mainsnak']['datavalue']['value']['amount'];
    $fullContent .= '<li class="list-group-item d-flex justify-content-between align-items-center"><span class="fw-semibold">Diện tích:</span> <span>' . e($area) . ' km²</span></li>';
}






// Night view (P3451)
if (isset($entity['claims']['P3451'][0]['mainsnak']['datavalue']['value'])) {
    $nightViewName = $entity['claims']['P3451'][0]['mainsnak']['datavalue']['value'];
    $nightViewCommons = str_replace(' ', '_', $nightViewName);
    $nightViewMd5 = md5($nightViewCommons);
    $nightViewUrl = "https://upload.wikimedia.org/wikipedia/commons/{$nightViewMd5[0]}/{$nightViewMd5[0]}{$nightViewMd5[1]}/{$nightViewCommons}";
    $fullContent .= '<li class="list-group-item">
        <span class="fw-semibold d-block mb-1">Quan cảnh buổi đêm:</span>
        <img src="' . e($nightViewUrl) . '" alt="Quan cảnh buổi đêm" class="rounded shadow w-100 h-auto border border-secondary">
    </li>';
}

$fullContent .= '
    </ul>
  </div>
</div>
';

        // 3. Get image from Wikimedia Commons (P18 property)
        $image = null;
        if (isset($entity['claims']['P18'][0]['mainsnak']['datavalue']['value'])) {
            $imageName = $entity['claims']['P18'][0]['mainsnak']['datavalue']['value'];
            // Wikimedia Commons image URL format
            $commonsName = str_replace(' ', '_', $imageName);
            $md5 = md5($commonsName);
            $image = "https://upload.wikimedia.org/wikipedia/commons/{$md5[0]}/{$md5[0]}{$md5[1]}/{$commonsName}";
        }

        return [
            'title' => $title,
            'summary' => $summary,
            'image' => $image,
            'url' => $url,
            'fullcontent' => $fullContent,
        ];
    }
}