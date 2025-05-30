<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    // Hiển thị danh sách tất cả các tour
    public function index()
    {
        $tours = Tour::with('reviews')->latest()->paginate(9);
        $tours->getCollection()->transform(function ($tour) {
            $reviews = $tour->reviews;
            $tour->reviews_count = $reviews->count();
            $tour->avg_rating = $tour->reviews_count ? round($reviews->avg('rating'), 1) : null;
            return $tour;
        });

        return view('frontend.tour.index', compact('tours'));
    }
}
