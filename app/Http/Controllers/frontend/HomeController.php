<?php

namespace App\Http\Controllers\frontend;
use App\Models\Place;
use App\Models\Review;
use App\Models\Tour;
class HomeController
{
    public function index()
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

        // Tính điểm trung bình từng tỉnh
        $provinceRatings = [];
        foreach ($provinces as $province) {
            $placeIds = Place::where('provinces', $province)->pluck('id');
            $avg = Review::whereIn('reviewable_id', $placeIds)
                ->where('reviewable_type', Place::class)
                ->avg('rating');
            $provinceRatings[$province] = $avg ?? 0;
        }
        arsort($provinceRatings); // Sắp xếp giảm dần
        $topProvinces = array_slice(array_keys($provinceRatings), 0, 6); // Lấy 6 tỉnh có rating cao nhất
        $topTours = Tour::withCount('reviews')
            ->withCount(['reviews as avg_rating' => function($query) {
                $query->select(\DB::raw('coalesce(avg(rating),0)'));
            }])
            ->orderByDesc('avg_rating')
            ->orderByDesc('reviews_count')
            ->limit(6)
            ->get();
        // Truyền sang view
        return view('frontend.home.index', compact('topProvinces', 'provinces', 'topTours'));
    }
}
