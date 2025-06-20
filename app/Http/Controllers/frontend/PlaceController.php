<?php

namespace App\Http\Controllers\frontend;
use App\Models\Place;
use App\Models\PlaceMedia;
use App\Models\Province;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceController
{
    public function index(Request $request)
    {
        $places = Place::with('placeMedia')->limit(6)->get();

        $provinces = Province::query()->get();
        $have_more = 1;
        return view('frontend.destination.index', compact('provinces', 'places', 'have_more'));
    }
    public function detail(Request $request, $id)
    {
        $Place = Place::findOrFail($id);

        $primaryMedia = PlaceMedia::where('place_id', $id)
            ->where('is_primary', true)
            ->first();

        $otherMedia = PlaceMedia::where('place_id', $id)
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
        $relatedTours = \App\Models\Tour::whereHas('places', function($q) use ($Place) {
            $q->where('places.id', $Place->id);
        })
            ->orderByDesc('price')
            ->limit(4)
            ->get();
        return view('frontend.destination.detail', compact(
            'Place','primaryMedia','otherMedia',
            'reviews','totalReviews','averageRating','percentages','relatedTours'
        ));
    }
    public function more(Request $request)
    {
        $page = $request->input('pageParam');
        $perPage = 6;
        $skip = 6;
        $offset = ($page - 1) * $perPage + $skip;

        $keyword = $request->input('keyword');
        $province = $request->input('province');

        if ($keyword == null || $keyword == '') {
            $places = Place::with('placeMedia')->offset($offset)->limit($perPage)->get();

            $destination_next = Place::with('placeMedia')
                ->offset($offset + $perPage)
                ->limit(1)
                ->get();

            $have_more = $destination_next->isEmpty() ? 0 : 1;
        } else {
            $data = $this->search_result($keyword, $offset, $perPage, $province);
            $places = $data['place'];
            $have_more = $data['have_more'];
        }
        return view('frontend.destination.ajax.load_more_destination', compact('places', 'have_more'));
    }
    public function search(Request $request)
    {
        $have_more = 0;
        $keyword = $request->keyword;
        $province = $request->input('province');
        $offset = 0;
        $perPage = 6;
        if ($keyword == null && $province == null) {
            $places = Place::with('placeMedia')->limit(6)->get();
        }else{
            $data = $this->search_result($keyword, $offset, $perPage, $province);
//            dd($data);
            $places = $data['place'];
            $have_more = $data['have_more'];
        }
        $provinces = Province::query()->get();
        return view('frontend.destination.ajax.search_destination', compact('provinces', 'places', 'have_more'));
    }
    public function sort(Request $request)
    {
        $province_id = $request->province;
        if (!$province_id){
            $province_id = '';
        }
        $keyword = $request->input('keyword');
        $offset = 0;
        $limit = 6;

        if ($keyword == null) {
            $keyword = '';
        }

        $data = $this->search_result($keyword, $offset, $limit, $province_id);
        $places = $data['place'];
        $have_more = $data['have_more'];

        $provinces = Province::all();

        return view('frontend.destination.ajax.search_destination', compact('provinces', 'places', 'have_more'));
    }

    public function search_result($keyword, $offset = 0, $limit = 6, $province_id = '')
    {
        $have_more = 1;
        $escapedKeyword = addcslashes($keyword, '%_');

        $query = Place::with('placeMedia')
            ->with(['ward.district.province'])
            ->where('places.name', 'like', '%' . $escapedKeyword . '%');

        if ($province_id != '' || $province_id != null) {
            $query->join('wards', 'places.ward_id', '=', 'wards.id')
                ->join('districts', 'wards.district_id', '=', 'districts.id')
                ->join('provinces', 'districts.province_id', '=', 'provinces.id')
                ->where('provinces.id', '=', $province_id)
                ->select('places.*');
        }

        $places = $query->orderBy('id', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();

        $destination_next = (clone $query)
            ->offset($offset + $limit)
            ->limit(1)
            ->get();

        if ($destination_next->isEmpty()) {
            $have_more = 0;
        }

        return [
            'place' => $places,
            'have_more' => $have_more,
        ];
    }

}
