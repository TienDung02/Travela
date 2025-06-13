<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;

class StatisticManagementController extends Controller
{
    public function index(Request $request)
    {
        // Revenue by month (all years)
        $monthlyRevenue = OrderDetail::selectRaw("
                DATE_FORMAT(orders.created_at, '%Y-%m') as month,
                SUM(order_details.price * order_details.quantity) as revenue
            ")
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

        // Revenue by year
        $yearlyRevenue = OrderDetail::selectRaw("
                YEAR(orders.created_at) as year,
                SUM(order_details.price * order_details.quantity) as revenue
            ")
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        // Revenue by type (tour/package) by month
        $monthlyTypeRevenue = OrderDetail::selectRaw("
                DATE_FORMAT(orders.created_at, '%Y-%m') as month,
                order_details.item_type,
                SUM(order_details.price * order_details.quantity) as revenue
            ")
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->groupBy('month', 'order_details.item_type')
            ->orderBy('month', 'desc')
            ->get();

        // Revenue by type (tour/package) by year
        $yearlyTypeRevenue = OrderDetail::selectRaw("
                YEAR(orders.created_at) as year,
                order_details.item_type,
                SUM(order_details.price * order_details.quantity) as revenue
            ")
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->groupBy('year', 'order_details.item_type')
            ->orderBy('year', 'desc')
            ->get();

        // Total revenue (all time)
        $totalRevenue = OrderDetail::join('orders', 'orders.id', '=', 'order_details.order_id')
            ->sum(DB::raw('order_details.price * order_details.quantity'));

        return view('backend.admin-statistic.index', compact(
            'monthlyRevenue', 'yearlyRevenue', 'monthlyTypeRevenue', 'yearlyTypeRevenue', 'totalRevenue'
        ));
    }
}