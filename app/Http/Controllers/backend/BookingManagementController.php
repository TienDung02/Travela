<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingManagementController extends Controller
{
    //
    public function index()
    {
        return view('backend.admin-booking.index', [
          
        ]);
    }
}
