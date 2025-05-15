<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
class BookingController extends Controller
{
    public function create($id)
    {
        $package = Package::findOrFail($id);
        return view('frontend.booking.create', compact('package'));
    }


    public function index()
    {
        return view('frontend.booking.index');
    }
}
