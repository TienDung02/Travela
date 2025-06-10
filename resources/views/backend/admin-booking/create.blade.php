@extends('backend.layouts.layout')
@section('title', 'Add Order')
@section('content')
<div class="container py-4">
    <form method="POST" action="{{ route('admin.booking.store') }}">
        @csrf
        <div class="mb-3">
            <label>Customer</label>
            <select name="customer_id" class="form-control" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->fullname }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Deposit</label>
            <select name="deposit" class="form-control" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
    
        <div class="mb-3">
            <label>Payment Method</label>
            <input type="text" name="payment_method" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Order Details</label>
            <div id="order-details-list">
                <div class="order-detail-row mb-2">
                    <select name="order_details[0][item_type]" class="form-select d-inline w-auto" required>
                        <option value="tour">Tour</option>
                        <option value="package">Package</option>
                    </select>
                    <select name="order_details[0][item_id]" class="form-select d-inline w-auto" required>
                        @foreach($tours as $tour)
                            <option value="{{ $tour->id }}" data-type="tour">Tour: {{ $tour->name }}</option>
                        @endforeach
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" data-type="package">Package: {{ $package->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="order_details[0][quantity]" class="form-control d-inline w-auto" placeholder="Qty" value="1" min="1" required>
                    <input type="number" name="order_details[0][price]" class="form-control d-inline w-auto" placeholder="Price" value="0" min="0" required>
                    <button type="button" class="btn btn-danger btn-sm remove-detail">Remove</button>
                </div>
            </div>
            <button type="button" class="btn btn-secondary btn-sm" id="add-detail">Add Detail</button>
        </div>
        <button class="btn btn-success">Create Order</button>
    </form>
</div>
<script>
    let detailIndex = 1;
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