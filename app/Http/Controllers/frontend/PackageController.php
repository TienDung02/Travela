<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index(Request $request)
    {
            $query = Package::with(['tour.place']);

            if ($request->has('search') && $request->search != '') {
                $query->where(function($q) use ($request){
                    $q->where('name', 'like', '%' . $request->search .'%')
                      ->orWhere('desc', 'like', '%' . $request->search . '%')
                      ->orWhereHas('tour.place', function($subQuery) use ($request) {
                          $subQuery->where('address', 'like', '%' . $request->search . '%');
                      });
                });
            }

            if ($request->filled('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }

            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }

            if ($request->filled('rating')){
                $query->whereHas('reviews', function ($q) use ($request) {
                    $q->select('reviewable_id')
                      ->where('reviewable_type', Package::class)
                      ->whereIn('rating', $request->rating);
                });
            }

            $packages = $query->paginate(9);

            return view('frontend.packages.index', compact('packages'));
        }

    public function show($id)
    {
        $package = Package::with(['tour.place'])->findOrFail($id);
        return view('frontend.packages.show', compact('package'));
    }

}
