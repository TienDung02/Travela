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
            WHEN ? = 'month' THEN DATE_FORMAT(start_date, '%Y-%m')
            WHEN ? = 'quarter' THEN CONCAT(YEAR(start_date), '-Q', QUARTER(start_date))
            WHEN ? = 'year' THEN YEAR(start_date)
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

        // Top packages based on orders (order_details with item_type 'package')
        $topPackages = Package::select('packages.id', 'packages.name', DB::raw('COUNT(order_details.id) as order_count'))
            ->leftJoin('order_details', function($join) {
            $join->on('packages.id', '=', 'order_details.item_id')
                 ->where('order_details.item_type', '=', 'package');
            })
            ->groupBy('packages.id', 'packages.name')
            ->orderByDesc('order_count')
            ->take(5)
            ->get();

        // Fetch top tours based on orders (order_details with item_type 'tour')
        $topTours = Tour::select('tours.id', 'tours.name', DB::raw('COUNT(order_details.id) as order_count'))
            ->leftJoin('order_details', function($join) {
                $join->on('tours.id', '=', 'order_details.item_id')
                     ->where('order_details.item_type', '=', 'tour');
            })
            ->groupBy('tours.id', 'tours.name')
            ->orderByDesc('order_count')
            ->take(5)
            ->get();

        // Fetch top places (most visited based on orders)
        // Top places based on tour_place and orders (order_details)
        $topPlaces = Place::select('places.id', 'places.name', DB::raw('COUNT(order_details.id) as visit_count'))
            ->leftJoin('tour_places', 'places.id', '=', 'tour_places.place_id')
            ->leftJoin('tours', 'tour_places.tour_id', '=', 'tours.id')
            ->leftJoin('order_details', function($join) {
            $join->on('tours.id', '=', 'order_details.item_id')
                 ->where('order_details.item_type', '=', 'tour');
            })
            ->groupBy('places.id', 'places.name')
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
