<?php

namespace App\Http\Controllers\frontend;
use App\Models\Place;
use App\Models\Review;
use Illuminate\Http\Request;

class PlaceController
{
    public function index(Request $request)
    {
        $provinces = [
            'An Giang', 'Bà Rịa - Vũng Tàu', 'Bạc Liêu', 'Bắc Giang', 'Bắc Kạn', 'Bắc Ninh',
            'Bến Tre', 'Bình Dương', 'Bình Định', 'Bình Phước', 'Bình Thuận', 'Cà Mau',
            'Cao Bằng', 'Cần Thơ', 'Đà Nẵng', 'Đắk Lắk', 'Đắk Nông', 'Điện Biên',
            'Đồng Nai', 'Đồng Tháp', 'Gia Lai', 'Hà Giang', 'Hà Nam', 'Hà Nội', 'Hà Tĩnh',
            'Hải Dương', 'Hải Phòng', 'Hậu Giang', 'Hòa Bình', 'Hưng Yên', 'Khánh Hòa',
            'Kiên Giang', 'Kon Tum', 'Lai Châu', 'Lâm Đồng', 'Lạng Sơn', 'Lào Cai',
            'Long An', 'Nam Định', 'Nghệ An', 'Ninh Bình', 'Ninh Thuận', 'Phú Thọ',
            'Phú Yên', 'Quảng Bình', 'Quảng Nam', 'Quảng Ngãi', 'Quảng Ninh', 'Quảng Trị',
            'Sóc Trăng', 'Sơn La', 'Tây Ninh', 'Thái Bình', 'Thái Nguyên', 'Thanh Hóa',
            'Thừa Thiên Huế', 'Tiền Giang', 'TP. Hồ Chí Minh', 'Trà Vinh', 'Tuyên Quang',
            'Vĩnh Long', 'Vĩnh Phúc', 'Yên Bái'
        ];
        
        $tab    = $request->query('tab', 'all');
        $page   = $request->query('page', 1);

        // build mảng Places['all'], Places['usa'], ...
        $Places = [];
        foreach ($provinces as $c) {
            if ($c === 'all') {
                $Places['all'] = Place::paginate(9, ['*'], 'page', $page);
            } else {
                $Places[$c] = Place::where('provinces', $c)
                   ->paginate(9, ['*'], 'page', $page);
            }
        }
        $provinceRatings = [];
        foreach ($provinces as $province) {
            $placeIds = Place::where('provinces', $province)->pluck('id');
            $avg = Review::whereIn('reviewable_id', $placeIds)
                ->where('reviewable_type', Place::class)
                ->avg('rating');
            $provinceRatings[$province] = $avg ?? 0;
        }
        arsort($provinceRatings); // Sắp xếp giảm dần
        $topProvinces = array_slice(array_keys($provinceRatings), 0, 6); // Tỉnh có rating cao nhất
        return view('frontend.destination.index', [
            'topProvinces' => $topProvinces,
            'provinces' => $provinces,
            'showAll' => false,
        ]);
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
    public function all(Request $request)
    {
        $provinces = [
            'An Giang', 'Bà Rịa - Vũng Tàu', 'Bạc Liêu', 'Bắc Giang', 'Bắc Kạn', 'Bắc Ninh',
            'Bến Tre', 'Bình Dương', 'Bình Định', 'Bình Phước', 'Bình Thuận', 'Cà Mau',
            'Cao Bằng', 'Cần Thơ', 'Đà Nẵng', 'Đắk Lắk', 'Đắk Nông', 'Điện Biên',
            'Đồng Nai', 'Đồng Tháp', 'Gia Lai', 'Hà Giang', 'Hà Nam', 'Hà Nội', 'Hà Tĩnh',
            'Hải Dương', 'Hải Phòng', 'Hậu Giang', 'Hòa Bình', 'Hưng Yên', 'Khánh Hòa',
            'Kiên Giang', 'Kon Tum', 'Lai Châu', 'Lâm Đồng', 'Lạng Sơn', 'Lào Cai',
            'Long An', 'Nam Định', 'Nghệ An', 'Ninh Bình', 'Ninh Thuận', 'Phú Thọ',
            'Phú Yên', 'Quảng Bình', 'Quảng Nam', 'Quảng Ngãi', 'Quảng Ninh', 'Quảng Trị',
            'Sóc Trăng', 'Sơn La', 'Tây Ninh', 'Thái Bình', 'Thái Nguyên', 'Thanh Hóa',
            'Thừa Thiên Huế', 'Tiền Giang', 'TP. Hồ Chí Minh', 'Trà Vinh', 'Tuyên Quang',
            'Vĩnh Long', 'Vĩnh Phúc', 'Yên Bái'
        ];
        $query = Place::where('status', true);

        if ($request->filled('province')) {
            $query->where('provinces', $request->province);
        }
        $places = $query->get();
        // Nếu có tìm kiếm, lọc danh sách
        if ($request->filled('search')) {
            $search = strtolower(convertVietnameseToLatin($request->search));
            $selectedProvince = null;
            foreach ($provinces as $province) {
                $provinceLatin = strtolower(convertVietnameseToLatin($province));
                if (str_contains($provinceLatin, $search) && strlen($search) >= 4) {
                    $selectedProvince = $province;
                    break;
                }
            }
            $places = $places->filter(function($place) use ($search) {
                return str_contains(strtolower(convertVietnameseToLatin($place->name)), $search)
                    || str_contains(strtolower(convertVietnameseToLatin($place->provinces)), $search);
            });
            // Phân trang thủ công...
            $page = $request->get('page', 1);
            $perPage = 9;
            $allPlaces = new \Illuminate\Pagination\LengthAwarePaginator(
                $places->forPage($page, $perPage),
                $places->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        } else {
            $selectedProvince = $request->province ?? null;
            $allPlaces = $query->paginate(9);
        }
        
        $places = Place::where('status', true)->get();
        // Có thể truyền thêm các biến khác nếu view index cần
        $Places = []; // hoặc null, hoặc build như trên
        $places = Place::where('status', true)->get();
        return view('frontend.destination.index', [
            'allPlaces' => $allPlaces,
            'provinces' => $provinces,
            'showAll' => true,
            'selectedProvince' => $selectedProvince,
        ]);
    }

}
