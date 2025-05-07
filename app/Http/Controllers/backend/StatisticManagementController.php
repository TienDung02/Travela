<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticManagementController extends Controller
{
    public function index()
    {
        return view('backend.admin-statistic.index', [
           
        ]);
    }
}
