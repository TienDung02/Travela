@extends('backend.layouts.layout')
@section('title', 'Edit Order')
@section('content')
<div class="container py-4">
    <form method="POST" action="{{ route('admin.booking.update', $order->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Customer</label>
            <select name="customer_id" class="form-control" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" @if($order->customer_id == $customer->id) selected @endif>
                        {{ $customer->fullname }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                <option value="confirmed" @if($order->status == 'confirmed') selected @endif>Confirmed</option>
                <option value="cancelled" @if($order->status == 'cancelled') selected @endif>Cancelled</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Deposit</label>
            <select name="deposit" class="form-control" required>
                <option value="1" @if($order->deposit) selected @endif>Yes</option>
                <option value="0" @if(!$order->deposit) selected @endif>No</option>
            </select>
        </div>
       
        <div class="mb-3">
            <label>Payment Method</label>
            <input type="text" name="payment_method" class="form-control" value="{{ $order->payment_method }}" required>
        </div>
        <div class="mb-3">
            <label>Order Details</label>
            <div id="order-details-list">
                @foreach($order->orderDetails as $i => $detail)
                <div class="order-detail-row mb-2">
                    <select name="order_details[{{ $i }}][item_type]" class="form-select d-inline w-auto" required>
                        <option value="tour" @if($detail->item_type == 'tour') selected @endif>Tour</option>
                        <option value="package" @if($detail->item_type == 'package') selected @endif>Package</option>
                    </select>
                    <select name="order_details[{{ $i }}][item_id]" class="form-select d-inline w-auto" required>
                        @foreach($tours as $tour)
                            <option value="{{ $tour->id }}" data-type="tour" @if($detail->item_type == 'tour' && $detail->item_id == $tour->id) selected @endif>
                                Tour: {{ $tour->name }}
                            </option>
                        @endforeach
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" data-type="package" @if($detail->item_type == 'package' && $detail->item_id == $package->id) selected @endif>
                                Package: {{ $package->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="number" name="order_details[{{ $i }}][quantity]" class="form-control d-inline w-auto" placeholder="Qty" value="{{ $detail->quantity }}" min="1" required>
                    <input type="number" name="order_details[{{ $i }}][price]" class="form-control d-inline w-auto" placeholder="Price" value="{{ $detail->price }}" min="0" required>
                    <button type="button" class="btn btn-danger btn-sm remove-detail">Remove</button>
                </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-secondary btn-sm" id="add-detail">Add Detail</button>
        </div>
        <button class="btn btn-success">Update Order</button>
    </form>
</div>
<script>
    let detailIndex = {{ count($order->orderDetails) }};
    document.getElementById('add-detail').onclick = function() {
        let row = document.createElement('div');
        row.className = 'order-detail-row mb-2';
        row.innerHTML = `
            <select name="order_details[${detailIndex}][item_type]" class="form-select d-inline w-auto" required>
                <option value="tour">Tour</option>
                <option value="package">Package</option>
            </select>
            <select name="order_details[${detailIndex}][item_id]" class="form-select d-inline w-auto" required>
                @foreach($tours as $tour)
                    <option value="{{ $tour->id }}" data-type="tour">Tour: {{ $tour->name }}</option>
                @endforeach
                @foreach($packages as $package)
                    <option value="{{ $package->id }}" data-type="package">Package: {{ $package->name }}</option>
                @endforeach
            </select>
            <input type="number" name="order_details[${detailIndex}][quantity]" class="form-control d-inline w-auto" placeholder="Qty" value="1" min="1" required>
            <input type="number" name="order_details[${detailIndex}][price]" class="form-control d-inline w-auto" placeholder="Price" value="0" min="0" required>
            <button type="button" class="btn btn-danger btn-sm remove-detail">Remove</button>
        `;
        document.getElementById('order-details-list').appendChild(row);
        detailIndex++;
    };
    document.addEventListener('click', function(e){
        if(e.target.classList.contains('remove-detail')){
            e.target.parentElement.remove();
        }
    });
</script>
@endsection