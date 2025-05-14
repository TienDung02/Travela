<?php

namespace App\Http\Controllers\frontend;
use App\Models\Place;
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

        return view('frontend.destination.detail', compact('Place', 'primaryMedia', 'otherMedia'));
    }

}
