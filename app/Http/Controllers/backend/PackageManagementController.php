<?php
namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Tour;
use App\Models\Place;
use App\Models\TourPlace;

class PackageManagementController extends Controller
{
    public function index()
    {
        $packages = Package::with('tour')->get();
        $tours = Tour::all();
        $places = Place::all();

        // For each tour, get its places via TourPlace
        $tourPlaces = [];
        foreach ($tours as $tour) {
            $tourPlaces[$tour->id] = TourPlace::where('tour_id', $tour->id)->pluck('place_id')->toArray();
        }

        return view('backend.admin-package.index', compact('packages', 'tours', 'places', 'tourPlaces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'nullable',
            'price' => 'required|numeric',
            'tour_id' => 'required|exists:tours,id',
        ]);
        Package::create($request->all());
        return redirect()->route('admin.package.index')->with('success', 'Package created!');
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'desc' => 'nullable',
            'price' => 'required|numeric',
            'tour_id' => 'required|exists:tours,id',
        ]);
        $package->update($request->all());
        return redirect()->route('admin.package.index')->with('success', 'Package updated!');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return redirect()->route('admin.package.index')->with('success', 'Package deleted!');
    }
}