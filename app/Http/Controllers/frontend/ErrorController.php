<?php

namespace App\Http\Controllers\frontend;

class ErrorController
{
    public function index()
    {
        return view('frontend.404');
    }
}
