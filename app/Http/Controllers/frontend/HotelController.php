<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\HotelMedia;

class HotelController extends Controller
{
    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        $media = HotelMedia::where('hotel_id', $id)
            ->orderBy('is_primary', 'desc')
            ->get();
            
        $primaryImage = $media->where('is_primary', 1)->first();
        $galleryImages = $media->where('is_primary', 0);
        
        return view('frontend.hotels.show', compact('hotel', 'primaryImage', 'galleryImages'));
    }
}
