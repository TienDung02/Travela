<div class="col-md-6 col-lg-4 col-xl-4 d-flex justify-content-center">
    <div class="card shadow-sm border-0 w-100" style="max-width: 260px;">
        <img src="{{ asset('frontend/images/' . ($package->main_image ?? 'default-package.jpg')) }}"
             class="card-img-top" alt="{{ $package->name }}" style="object-fit: cover; height: 160px;">
        <div class="card-body">
            <h6 class="fw-bold mb-1">{{ $package->name }}</h6>
            @if ($package->tour && $package->tour->place && $package->tour->place->address)
                <p class="text-muted mb-1">
                    <i class="fa fa-map-marker-alt me-1"></i> {{ $package->tour->place->address }}
                </p>
            @endif
            <p class="small text-muted text-truncate">{{ $package->desc }}</p>
        <div class="d-flex justify-content-between align-items-center mt-2">
            <span class="fw-bold text-danger">{{ number_format($package->price, 0, ',', '.') }} VND</span>
        </div>
        <div class="d-flex justify-content-between mt-2">
            <a href="{{ route('package.show', $package->id) }}" class="btn btn-outline-secondary btn-sm">Read More</a>
            <a href="{{ route('booking.create', $package->id) }}" class="btn btn-primary btn-sm">Book Now</a>
        </div>
        </div>
    </div>
</div>
