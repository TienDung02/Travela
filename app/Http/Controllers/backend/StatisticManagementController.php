<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Package;

class StatisticManagementController extends Controller
{
    public function index()
    {
        // Example: Assume 'price' is revenue, 'cost' is operating cost in Tour and Package
        $tourRevenue = Tour::sum('price');
        $tourCost = Tour::sum('cost');
        $packageRevenue = Package::sum('price');
        $packageCost = Package::sum('cost');

        $totalRevenue = $tourRevenue + $packageRevenue;
        $totalCost = $tourCost + $packageCost;
        $profit = $totalRevenue - $totalCost;

        return view('backend.admin-statistic.index', compact(
            'tourRevenue', 'tourCost', 'packageRevenue', 'packageCost', 'totalRevenue', 'totalCost', 'profit'
        ));
    }
}