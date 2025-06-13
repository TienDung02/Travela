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
        $query = Tour::with(['reviews', 'packages', 'places']);

// Lọc giá
        if ($request->filled('price')) {
            $query->whereRaw('CAST(price AS DECIMAL(10,2)) >= ?', [(float)$request->price]);
        }
// Lọc duration
        if ($request->filled('duration') && (int)$request->duration > 0) {
            $query->whereHas('places', function($q) use ($request) {
                // Đã sửa: Chỉ chọn tour_places.tour_id và cột tổng hợp total_days
                $q->select('tour_places.tour_id') // Chọn tour_places.tour_id vì nó nằm trong GROUP BY
                ->selectRaw('SUM(tour_places.duration_days) as total_days') // Chọn cột được tổng hợp
                ->groupBy('tour_places.tour_id')
                    ->havingRaw('SUM(tour_places.duration_days) = ?', [(int)$request->duration]);
            });
        }

// Sắp xếp
        if ($request->filled('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }
// Lấy tất cả tour sau khi đã filter
        $tours = $query->get();

        // Lọc rating bằng PHP
        if ($request->filled('rating')) {
            $tours = $tours->filter(function ($tour) use ($request) {
                foreach ($request->rating as $range) {
                    [$min, $max] = explode('-', $range);
                    $avg = $tour->reviews->avg('rating');
                    if ($avg >= (float)$min && $avg <= (float)$max) {
                        return true;
                    }
                }
                return false;
            });
        }

        // Phân trang thủ công
        $page = $request->input('page', 1);
        $perPage = 4;
        $paged = $tours->slice(($page - 1) * $perPage, $perPage)->values();
        $tours = new \Illuminate\Pagination\LengthAwarePaginator(
            $paged,
            $tours->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Tính toán lại các trường hiển thị
        $tours->getCollection()->transform(function ($tour) {
            $reviews = $tour->reviews;
            $tour->reviews_count = $reviews->count();
            $tour->avg_rating = $reviews->count() ? round($reviews->avg('rating'), 1) : null;
            $tour->total_duration = $tour->places->sum(function($place) {
                return $place->pivot->duration_days ?? 0;
            });
            return $tour;
        });

        return view('frontend.tour.index', compact('tours'));
    }
    public function detail($id)
    {
        $tour = Tour::with(['reviews.user', 'packages', 'places'])->findOrFail($id);
        $reviews = $tour->reviews()->latest()->paginate(5);
        $tour->reviews_count = $reviews->total();
        $tour->avg_rating = $reviews->count() ? round($reviews->avg('rating'), 1) : null;
        // Tính tổng thời gian
        $tour->total_duration = $tour->places->sum(function($place) {
            return $place->pivot->duration_days ?? 0;
        });
        $otherTours = \App\Models\Tour::where('id', '!=', $tour->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        return view('frontend.tour.detail', compact('tour', 'reviews', 'otherTours'));
    }
}
