<?php
namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Place;
use App\Models\TourPlace;

class TourManagementController extends Controller
{
    public function index()
    {
        $tours = Tour::all();
        $places = Place::all();

        // For each tour, get its places via TourPlace
        $tourPlaces = [];
        foreach ($tours as $tour) {
            $tourPlaces[$tour->id] = TourPlace::where('tour_id', $tour->id)->pluck('place_id')->toArray();
        }

        return view('backend.admin-package.index', compact('tours', 'places', 'tourPlaces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'nullable',
            'price' => 'required|numeric',
            'hotel' => 'nullable|string',
            'rental' => 'nullable|string',
            'tour_guide' => 'nullable|string',
            'places' => 'array',
            'places.*' => 'exists:places,id',
        ]);
        $tour = Tour::create($request->only(['name', 'desc', 'price', 'hotel', 'rental', 'tour_guide']));

        // Sync TourPlace
        if ($request->has('places')) {
            foreach ($request->places as $placeId) {
                TourPlace::create([
                    'tour_id' => $tour->id,
                    'place_id' => $placeId,
                ]);
            }
        }
        return redirect()->route('admin.package.index')->with('success', 'Tour created!');
    }

    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'desc' => 'nullable',
            'price' => 'required|numeric',
            'hotel' => 'nullable|string',
            'rental' => 'nullable|string',
            'tour_guide' => 'nullable|string',
            'places' => 'array',
            'places.*' => 'exists:places,id',
        ]);
        $tour->update($request->only(['name', 'desc', 'price', 'hotel', 'rental', 'tour_guide']));

        // Sync TourPlace
        TourPlace::where('tour_id', $tour->id)->delete();
        if ($request->has('places')) {
            foreach ($request->places as $placeId) {
                TourPlace::create([
                    'tour_id' => $tour->id,
                    'place_id' => $placeId,
                ]);
            }
        }
        return redirect()->route('admin.package.index')->with('success', 'Tour updated!');
    }

    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        TourPlace::where('tour_id', $tour->id)->delete();
        $tour->delete();
        return redirect()->route('admin.package.index')->with('success', 'Tour deleted!');
    }
}