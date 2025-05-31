<?php


namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;

class PlaceManagementController extends Controller
{
    public function index()
    {
        $places = Place::all();
        return view('backend.admin-package.index', compact('places'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'country' => 'required',
            'desc' => 'nullable',
        ]);
        Place::create($request->all());
        return redirect()->route('admin.package.index')->with('success', 'Destination created!');
    }

    public function update(Request $request, $id)
    {
        $place = Place::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'country' => 'required',
            'desc' => 'nullable',
        ]);
        $place->update($request->all());
        return redirect()->route('admin.package.index')->with('success', 'Destination updated!');
    }

    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();
        return redirect()->route('admin.package.index')->with('success', 'Destination deleted!');
    }
}