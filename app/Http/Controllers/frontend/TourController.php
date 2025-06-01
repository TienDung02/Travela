<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    // Hiển thị danh sách tất cả các tour
    public function index(Request $request)
{
    $query = Tour::with(['reviews', 'packages']);
    // Lọc theo khoảng giá (nếu có)
    if ($request->filled('price')) {
        $query->where('price', '>=', $request->price);
    }
    // Lọc theo tour nổi bật (nếu có)
    if ($request->filled('public_choice') && in_array('filter1', $request->public_choice)) {
        $query->where('is_featured', true);
    }
    // Lọc theo rating (nếu có)
    if ($request->filled('rating')) {
        $query->where(function ($q) use ($request) {
            foreach ($request->rating as $i => $range) {
                [$min, $max] = explode('-', $range);
                if ($i === 0) {
                    $q->whereBetween('avg_rating', [(float)$min, (float)$max]);
                } else {
                    $q->orWhereBetween('avg_rating', [(float)$min, (float)$max]);
                }
            }
        });
    }
    // Lọc theo loại tour (nếu có)
    if ($request->filled('tour_type')){
        $query->where(function($q) use ($request) {
            foreach ($request->tour_type as $type) {
                $q->orWhereJsonContains('types', $type);
            }
        });
    }
    if ($request->filled('sort')) {
        if ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest(); // Mặc định
        }
    } else {
        $query->latest();
    }
    $tours = $query->latest()->paginate(9);
    // Tính toán rate trung bình từ rating của reviews và lưu vào cột avg_rating của db tour
    $tours->getCollection()->transform(function ($tour) {
        $reviews = $tour->reviews;
        $tour->reviews_count = $reviews->count();
        $avgRating = $reviews->count() ? round($reviews->avg('rating'), 1) : null;
        $tour->avg_rating = $avgRating;

        return $tour;
    });

    return view('frontend.tour.index', compact('tours'));
}
}