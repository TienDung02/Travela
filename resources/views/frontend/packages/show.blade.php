@extends('frontend.layouts.layout')

@section('content')
<!-- Package Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <h2 class="mb-4 text-uppercase">{{ $package->name }}</h2>

                <div class="mb-4">
                    <img src="{{ asset('frontend/images/' . ($package->main_image ?? 'default-package.jpg')) }}"
                         class="img-fluid rounded w-100" 
                         style="max-height: 400px; object-fit: cover;" 
                         alt="{{ $package->name }}">
                </div>

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item"><strong>Duration:</strong> 3 days</li>
                    <li class="list-group-item"><strong>People:</strong> {{ $package->people }} 1 Person</li>
                    <li class="list-group-item"><strong>Price:</strong> 
                        <span class="text-danger fw-bold">
                            {{ number_format($package->price, 0, ',', '.') }} VND
                        </span>
                    </li>
                </ul>

                <div class="mb-4">
                    <h5 class="fw-bold">Description</h5>
                    <p>{{ $package->desc }}</p>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('packages.index') }}" class="btn btn-outline-secondary">← Back to Packages</a>
                    <a href="{{ route('booking.create', ['id' => $package->id]) }}" class="btn btn-primary">Book Now</a>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection