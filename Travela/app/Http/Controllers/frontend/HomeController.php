<?php

namespace App\Http\Controllers\frontend;

class HomeController
{
    public function index()
    {
        return view('frontend.home.index');
    }
}
