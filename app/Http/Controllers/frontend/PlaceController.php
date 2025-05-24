<?php

namespace App\Http\Controllers\frontend;
use App\Models\Place;
use App\Models\Review;
use Illuminate\Http\Request;

class PlaceController
{
    public function index(Request $request)
    {
        $countries = ['USA','Canada','Europe','China','Singapore'];
        $tab    = $request->query('tab', 'all');
        $page   = $request->query('page', 1);

        // build mảng Places['all'], Places['usa'], ...
        $Places = [];
        foreach ($countries as $c) {
            if ($c === 'all') {
                $Places['all'] = Place::paginate(9, ['*'], 'page', $page);
            } else {
                // lưu ý: ở đây `country` trong DB có thể viết HOA, 
                // nên bạn map lại, ví dụ ucfirst():
                $Places[$c] = Place::where('country', $c)
                   ->paginate(9, ['*'], 'page', $page);
            }
        }

        return view('frontend.destination.index', compact('Places','tab'));
    }
    public function detail(Request $request, $id)
    {
        $Place = Place::findOrFail($id);

        $primaryMedia = \App\Models\PlaceMedia::where('place_id', $id)
            ->where('is_primary', true)
            ->first();

        $otherMedia = \App\Models\PlaceMedia::where('place_id', $id)
            ->where('is_primary', false)
            ->get();
        $reviewsQuery = Review::where('reviewable_type', Place::class)
        ->where('reviewable_id', $id);
    
        // 1) Thống kê
        $totalReviews = $reviewsQuery->count();
        $averageRating = $totalReviews
            ? round($reviewsQuery->avg('rating'), 1)
            : 0;
    
        // đếm từng rating, dùng một query mới
        $counts = Review::where('reviewable_type', Place::class)
            ->where('reviewable_id', $id)
            ->selectRaw('rating, COUNT(*) as cnt')
            ->groupBy('rating')
            ->pluck('cnt','rating')
            ->toArray();
    
        $percentages = [];
        for ($i = 5; $i >= 1; $i--) {
            $cnt = $counts[$i] ?? 0;
            $percentages[$i] = $totalReviews
                ? round($cnt / $totalReviews * 100)
                : 0;
        }
    
        // 2) Phân trang (vẫn dùng $reviewsQuery ban đầu, chưa bị mutate)
        $reviews = $reviewsQuery
            ->with('user')
            ->orderByDesc('created_at')
            ->paginate(5);
    
        return view('frontend.destination.detail', compact(
            'Place','primaryMedia','otherMedia',
            'reviews','totalReviews','averageRating','percentages'
        ));
    }

}
