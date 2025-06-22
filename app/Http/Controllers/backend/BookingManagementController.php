<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Tour;
use App\Models\Package;
use App\Models\Customer;

class BookingManagementController extends Controller
{
    // List all orders
    public function index()
    {
        $orders = Order::with(['customer', 'orderDetails'])->orderByDesc('id')->get();
        $tours = Tour::all();
        $packages = Package::all();
        $customers = Customer::all();
        return view('backend.admin-booking.index', compact('orders', 'tours', 'packages', 'customers'));
    }

    // Show create order form
    public function create()
    {
        $tours = Tour::all();
        $packages = Package::all();
        $customers = Customer::all();
        return view('backend.admin-booking.create', compact('tours', 'packages', 'customers'));
    }

    // Store new order
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required',
            'note' => 'nullable',
            'deposit' => 'required|boolean',
            'amount_pending' => 'required|numeric',
            'payment_method' => 'required|string',
            'order_details' => 'required|array|min:1',
            'order_details.*.item_type' => 'required|in:tour,package',
            'order_details.*.item_id' => 'required|integer',
            'order_details.*.quantity' => 'required|integer|min:1',
            'order_details.*.price' => 'required|numeric|min:0',
        ]);

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'status' => $request->status,
            'note' => $request->note,
            'deposit' => $request->deposit,
            'amount_pending' => $request->amount_pending,
            'payment_method' => $request->payment_method,
            'total_price' => collect($request->order_details)->sum(function($d){ return $d['price'] * $d['quantity']; }),
        ]);

        foreach ($request->order_details as $detail) {
            OrderDetail::create([
                'order_id' => $order->id,
                'item_type' => $detail['item_type'],
                'item_id' => $detail['item_id'],
                'quantity' => $detail['quantity'],
                'price' => $detail['price'],
            ]);
        }

        return redirect()->route('admin.booking.index')->with('success', 'Order created!');
    }

    // Show edit form
    public function edit($id)
    {
        $order = Order::with('orderDetails')->findOrFail($id);
        $tours = Tour::all();
        $packages = Package::all();
        $customers = Customer::all();
        return view('backend.admin-booking.edit', compact('order', 'tours', 'packages', 'customers'));
    }

    // Update order
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required',
            'note' => 'nullable',
            'deposit' => 'required|boolean',

            'payment_method' => 'required|string',
            'order_details' => 'required|array|min:1',
            'order_details.*.item_type' => 'required|in:tour,package',
            'order_details.*.item_id' => 'required|integer',
            'order_details.*.quantity' => 'required|integer|min:1',
            'order_details.*.price' => 'required|numeric|min:0',
        ]);

        $order->update([
            'customer_id' => $request->customer_id,
            'status' => $request->status,
            'note' => $request->note,
            'deposit' => $request->deposit,
            'amount_pending' => $request->amount_pending,
            'payment_method' => $request->payment_method,
            'total_price' => collect($request->order_details)->sum(function($d){ return $d['price'] * $d['quantity']; }),
        ]);

        // Remove old details and add new
        $order->orderDetails()->delete();
        foreach ($request->order_details as $detail) {
            OrderDetail::create([
                'order_id' => $order->id,
                'item_type' => $detail['item_type'],
                'item_id' => $detail['item_id'],
                'quantity' => $detail['quantity'],
                'price' => $detail['price'],
            ]);
        }

        return redirect()->route('admin.booking.index')->with('success', 'Order updated!');
    }

    // Delete order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->orderDetails()->delete();
        $order->delete();
        return redirect()->route('admin.booking.index')->with('success', 'Order deleted!');
    }
}
