<?php

namespace App\Http\Controllers\backend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController
{
    public function index(Request $request)
    {
        $timePeriod = $request->input('time_period', 'month'); // Default to 'month'

    $revenueData = DB::table('tours')
        ->selectRaw("
            CASE 
                WHEN ? = 'month' THEN strftime('%Y-%m', start_date)
                WHEN ? = 'quarter' THEN strftime('%Y', start_date) || '-Q' || ((CAST(strftime('%m', start_date) AS INTEGER) + 2) / 3)
                WHEN ? = 'year' THEN strftime('%Y', start_date)
            END AS period,
            SUM(price) AS revenue
        ", [$timePeriod, $timePeriod, $timePeriod])
        ->whereNull('deleted_at') // Exclude soft-deleted rows
        ->groupBy('period')
        ->orderBy('period')
        ->get();

       // dd($revenueData); // Debug the data
        return view('backend.dashboard.index', compact('revenueData', 'timePeriod'));
    }
}
