@extends('backend.layouts.layout')
@section('title', 'Booking Management')
@section('content')
<div class="container py-4">
    <a href="{{ route('admin.booking.create') }}" class="btn btn-primary mb-3">Add Order</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="min-w-full divide-y divide-gray-200 table table-bordered bg-white">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Deposit</th>
                <th>Amount Pending</th>
                <th>Payment Method</th>
                <th>Total Price</th>
                <th>Order Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer->fullname ?? '-' }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->deposit ? 'Yes' : 'No' }}</td>
           
                <td>{{ $order->payment_method }}</td>
                <td>{{ number_format($order->total_price) }}</td>
                <td>
                    <ul>
                        @foreach($order->orderDetails as $detail)
                            <li>
                                @if($detail->item_type == 'tour')
                                    Tour: {{ $tours->firstWhere('id', $detail->item_id)->name ?? '' }}
                                @elseif($detail->item_type == 'package')
                                    Package: {{ $packages->firstWhere('id', $detail->item_id)->name ?? '' }}
                                @endif
                                (Qty: {{ $detail->quantity }}, Price: {{ number_format($detail->price) }})
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{ route('admin.booking.edit', $order->id) }}" class="btn btn-info btn-sm">Edit</a>
                    <form action="{{ route('admin.booking.destroy', $order->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this order?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection