<?php

namespace App\Http\Controllers\backend;

class DashboardController
{
    public function index()
    {
        return view('backend.dashboard.index');
    }
}
