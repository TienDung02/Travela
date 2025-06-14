<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Package;

class BookingController extends Controller
{
    public function create($id)
    {
        $package = \App\Models\Package::findOrFail($id);
        return view('frontend.booking.index', compact('package'));
    }
    public function createTour($id)
    {
        $tour = \App\Models\Tour::findOrFail($id);
        return view('frontend.booking.index', compact('tour'));
    }

    public function index()
    {
        return view('frontend.booking.index');
    }
}
