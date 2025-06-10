<?php

namespace App\Http\Controllers\backend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Tour;
use App\Models\Package;
use App\Models\Place;
use App\Models\Review;
class DashboardController
{
    public function index(Request $request)
    {
       $timePeriod = $request->input('time_period', 'month'); // Default to 'month'

    // Fetch revenue data grouped by time period
        $revenueData = Tour::selectRaw("
            CASE 
                WHEN ? = 'month' THEN strftime('%Y-%m', start_date)
                WHEN ? = 'quarter' THEN strftime('%Y', start_date) || '-Q' || ((CAST(strftime('%m', start_date) AS INTEGER) + 2) / 3)
                WHEN ? = 'year' THEN strftime('%Y', start_date)
            END AS period,
            SUM(price) AS revenue
        ", [$timePeriod, $timePeriod, $timePeriod])
        ->groupBy('period')
        ->orderBy('period')
        ->get();
         // Fetch provider data
         $providerData = User::whereNotNull('provider') // Exclude null values
        ->where('provider', '!=', '') // Exclude empty strings
        ->select('provider', DB::raw('COUNT(*) as count'))
        ->groupBy('provider')
        ->pluck('count', 'provider')
        ->toArray();

        $topPackages = Package::with('tour')
        ->select('packages.*', DB::raw('COUNT(bookings.id) as booking_count'))
        ->leftJoin('tours', 'packages.tour_id', '=', 'tours.id') // Join packages with tours
        ->leftJoin('bookings', 'tours.id', '=', 'bookings.location_id') // Join tours with bookings via location_id
        ->groupBy('packages.id')
        ->orderByDesc('booking_count')
        ->take(5)
        ->get();

        // Fetch top tours (e.g., most popular)
        $topTours = Tour::select('tours.*', DB::raw('COUNT(bookings.id) as booking_count'))
        ->leftJoin('bookings', 'tours.id', '=', 'bookings.location_id') // Join tours with bookings via location_id
        ->groupBy('tours.id')
        ->orderByDesc('booking_count')
        ->take(5)
        ->get();

        // Fetch top places (e.g., most visited)
        $topPlaces = Tour::select('location', DB::raw('COUNT(*) as visit_count'))
        ->groupBy('location')
        ->orderByDesc('visit_count')
        ->take(5)
        ->get();
        

        $reviewSummary = Review::select(
        DB::raw('AVG(rating) as average_rating'),
        DB::raw('COUNT(*) as total_reviews'),
        DB::raw('SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_star'),
        DB::raw('SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as four_star'),
        DB::raw('SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as three_star'),
        DB::raw('SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as two_star'),
        DB::raw('SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as one_star')
        )->first();

   $orderCount = \App\Models\Order::count();

// Count orders by type (tour/package) via OrderDetails
    $tourOrderCount = \App\Models\OrderDetail::where('item_type', 'tour')->count();
    $packageOrderCount = \App\Models\OrderDetail::where('item_type', 'package')->count();
    $totalOrderDetails = $tourOrderCount + $packageOrderCount;

        // Pass to view
        return view('backend.dashboard.index', compact(
            'revenueData', 'timePeriod', 'providerData', 'topPackages', 'topTours', 'topPlaces', 'reviewSummary',
            'orderCount', 'tourOrderCount', 'packageOrderCount', 'totalOrderDetails'
        ));
    }
}
