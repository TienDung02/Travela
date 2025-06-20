<?php

namespace App\Http\Controllers\frontend;
use App\Models\Place;
use App\Models\Review;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;
class HomeController
{
    public function index()
    {

        $topPlaces = Place::select(
            'places.id',
            'places.name',
            'place_media.media',
            DB::raw('media_counts.total_media'),
            DB::raw('COUNT(tour_places.place_id) AS total_bookings_for_place')
        )
            ->join('tour_places', 'places.id', '=', 'tour_places.place_id')
            ->join('tours', 'tour_places.tour_id', '=', 'tours.id')
            ->join('order_details', function($join) {
                $join->on('tours.id', '=', 'order_details.item_id')
                    ->where('order_details.item_type', '=', 'tour');
            })
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('place_media', function($join) {
                $join->on('places.id', '=', 'place_media.place_id')
                    ->where('place_media.is_primary', '=', 1);
            })
            ->join(DB::raw('(
                SELECT place_id, COUNT(*) as total_media
                FROM place_media
                GROUP BY place_id
            ) as media_counts'), 'places.id', '=', 'media_counts.place_id')
            ->groupBy('places.id', 'places.name', 'place_media.media', 'media_counts.total_media')
            ->orderByDesc('total_bookings_for_place')
            ->limit(6)
            ->get();
//dd($topPlaces);
        $topTours = Tour::withCount('reviews')
            ->withCount(['reviews as avg_rating' => function($query) {
                $query->select(\DB::raw('coalesce(avg(rating),0)'));
            }])
            ->orderByDesc('avg_rating')
            ->orderByDesc('reviews_count')
            ->limit(6)
            ->get();
        // Truyền sang view
        return view('frontend.home.index', compact('topTours', 'topPlaces'));
    }
}
