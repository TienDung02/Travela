@extends('frontend.layouts.layout')
@section('content')

<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-brand p-0">
            <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Travela</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        @include('frontend.component.menu-top')
    </nav>
</div>
<!-- Navbar & Hero End -->

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb" style="background: linear-gradient(rgba(19, 53, 123, 0.5), rgba(19, 53, 123, 0.5)), url({{ asset('frontend/images/breadcrumb-bg.jpg') }});">
    <div class="container-fluid text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">{{ $hotel->name }}</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Hotels</a></li>
            <li class="breadcrumb-item active text-white">{{ $hotel->name }}</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<!-- Hotel Detail Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Hotel Images -->
            <div class="col-lg-8">
                <div class="hotel-detail-slider mb-4">
                    <div id="hotelCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded overflow-hidden">
                            @if($primaryImage)
                                <div class="carousel-item active">
                                    <img src="{{ asset($primaryImage->media) }}" class="d-block w-100" alt="Hotel Main Image">
                                </div>
                            @endif
                            
                            @foreach($galleryImages as $image)
                                <div class="carousel-item">
                                    <img src="{{ asset($image->media) }}" class="d-block w-100" alt="Hotel Image">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                
                <div class="mb-5">
                    <h4 class="mb-3">Hotel Description</h4>
                    <p>{!! nl2br(e($hotel->desc)) !!}</p>
                </div>
                
                <div class="mb-5">
                    <h4 class="mb-3">Hotel Features</h4>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="bg-light p-3 rounded text-center">
                                <i class="fa fa-wifi text-primary fa-2x mb-2"></i>
                                <h5 class="mb-0">Free WiFi</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-light p-3 rounded text-center">
                                <i class="fa fa-utensils text-primary fa-2x mb-2"></i>
                                <h5 class="mb-0">Restaurant</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-light p-3 rounded text-center">
                                <i class="fa fa-swimming-pool text-primary fa-2x mb-2"></i>
                                <h5 class="mb-0">Swimming Pool</h5>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-5">
                    <h4 class="mb-3">Location</h4>
                    <p><i class="fa fa-map-marker-alt text-primary me-2"></i> {{ $hotel->address }}</p>
                    <div class="map-container h-1/2" style="height: 300px;">
                        <div id="map" class="h-100"></div>
                    </div>
                </div>
            </div>
            
            <!-- Hotel Sidebar -->
            <div class="col-lg-4">
                <div class="bg-light rounded p-4 mb-4">
                    <h4 class="mb-3">Hotel Details</h4>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <h6 class="mb-2">Location:</h6>
                        <span>{{ $hotel->address }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <h6 class="mb-0">Rating</h6>
                        <span class="badge bg-warning text-dark fs-6">{{ number_format($hotel->star_rating, 1) }}</span>
                    </div>
                </div>
                
                <div class="bg-light rounded p-4">
                    <h4 class="mb-3">Book A Room</h4>
                    <form>
                        <div class="mb-3">
                            <label for="checkin" class="form-label">Check-in Date</label>
                            <input type="date" class="form-control" id="checkin">
                        </div>
                        <div class="mb-3">
                            <label for="checkout" class="form-label">Check-out Date</label>
                            <input type="date" class="form-control" id="checkout">
                        </div>
                        <div class="mb-3">
                            <label for="guests" class="form-label">Number of Guests</label>
                            <select class="form-select" id="guests">
                                <option value="1">1 Person</option>
                                <option value="2">2 People</option>
                                <option value="3">3 People</option>
                                <option value="4">4 People</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Book Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hotel Detail End -->

<!-- Map Script -->
@push('extra_scripts')
<script>
    function initMap() {
        let options = {
            center: {lat: 16.072163491469226, lng: 108.22690536081757},
            zoom: 14,
            mapType: "2d"
        }
        let map = new map4d.Map(document.getElementById("map"), options);
        
        // Add hotel marker
        let marker = new map4d.Marker({
            position: {lat: 16.072163491469226, lng: 108.22690536081757},
            title: "{{ $hotel->name }}",
            snippet: "{{ $hotel->address }}"
        });
        marker.setMap(map);
    }
</script>
<script src="https://api.map4d.vn/sdk/map/js?version=2.6&key=320fdc09342c67c6879c20e64e1475c0&mapId=680393095d65bdb7b81fdcaf&callback=initMap"></script>
@endpush

@include('.frontend.component.chatbot')

<!-- Footer Start -->
<div class="container-fluid footer py-5">
    <div class="container-fluid py-5">
        <!-- Footer content -->
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright text-body py-4">
    <div class="container-fluid">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center text-md-end mb-md-0">
                <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Travela</a>, All right reserved.
            </div>
            <div class="col-md-6 text-center text-md-start">
                Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>

@endsection
