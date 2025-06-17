@extends('frontend.layouts.layout')
@section('content')


    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        @include('frontend.component.navbar')

        <!-- Carousel Start -->
        <div class="carousel-header">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="{{asset("frontend/images/carousel-2.jpg")}}" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px; margin-top: 10rem;">
                                <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                                <h1 class="display-2 text-capitalize text-white mb-4">Let's The World Together!</h1>
                                <p class="mb-5 fs-4 fw-bold" style="text-shadow: 2px 2px #13357b;">Build your free trip plan & enjoy discounted activities!</p>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="{{route('schedule.index')}}">Discover Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('frontend/images/carousel-1.jpg')}}" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px; margin-top: 10rem;">
                                <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                                <h1 class="display-2 text-capitalize text-white mb-4">Find Your Perfect Tour At Travel</h1>
                                <p class="mb-5 fs-4 fw-bold" style="text-shadow: 2px 2px #13357b;">Build your free trip plan & enjoy discounted activities!</p>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="{{route('schedule.index')}}">Discover Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('frontend/images/carousel-3.jpg')}}" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px; margin-top: 10rem;">
                                <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                                <h1 class="display-2 text-capitalize text-white mb-4">You Like To Go?</h1>
                                <p class="mb-5 fs-4 fw-bold" style="text-shadow: 2px 2px #13357b;">Build your free trip plan & enjoy discounted activities!</p>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="{{route('schedule.index')}}">Discover Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="false"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon btn bg-primary" aria-hidden="false"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->
    </div>
    <!-- Navbar & Hero End -->





    <!-- Payment Start -->
    <div class="container-fluid destination py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px; margin-top: 10rem;">
                <h5 class="section-title px-3">Destination</h5>
                <h1 class="mb-0">Popular Destination</h1>
            </div>
            <div class="tab-class text-center col-lg-11 col-xl-11 col-xxl-9 mx-auto">
                <div class="w-100 d-flex justify-content-between align-items-center mb-4">
                    <div class="text-start">
                        <h5 class="mb-0" id="destination-title">
                            @if(!empty($showAll))
                                {{ isset($selectedProvince) && $selectedProvince ? $selectedProvince : 'All Place' }}
                            @else
                                Most Rating
                            @endif
                        </h5>
                    </div>
                    @if(!empty($showAll))
                    <div class="text-end">
                        <form method="get">
                            <select id="destination-select" name="province" class="form-select" style="width: 220px;" onchange="this.form.submit()">
                                <option value="">Tất cả tỉnh thành</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province }}" {{ (isset($selectedProvince) && $selectedProvince == $province) ? 'selected' : '' }}>{{ $province }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    @endif
                </div>
                <div class="tab-content">
                    <div id="tab-all" class="tab-pane fade show p-0 active">
                        @if(!empty($showAll) && isset($allPlaces))
                            <div class="row g-4">
                                @foreach($allPlaces as $place)
                                    <div class="col-lg-4">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{ asset('frontend/images/destination-1.jpg') }}" alt="{{ $place->name }}">
                                            <div class="destination-overlay p-4">
                                                <h4 class="text-white mb-2 mt-3">{{ $place->name }}</h4>
                                                <div class="text-white">{{ $place->provinces }}</div>
                                                <a href="{{ route('destination.detail', $place->id) }}" class="btn btn-primary mt-2">View Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                {{ $allPlaces->withQueryString()->links() }}
                            </div>
                        @else
                            <div id="destination-container" class="row g-4">
                                <div class="col-xl-12">
                                    <div class="row g-4">
                                        @foreach($topProvinces as $province)
                                            @php
                                                $topPlace = \App\Models\Place::where('provinces', $province)->first();
                                            @endphp
                                            <div class="col-lg-4 destination-item">
                                                <div class="destination-img">
                                                    <img class="img-fluid rounded w-100"
                                                        src="{{ $topPlace ? asset('frontend/images/destination-1.jpg') : asset('frontend/images/no-image.jpg') }}"
                                                        alt="">
                                                    <div class="destination-overlay p-4">
                                                        <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">
                                                            {{ $topPlace ? $topPlace->reviews()->count() : 0 }} Photos
                                                        </a>
                                                        <h4 class="text-white mb-2 mt-3">{{ $province }}</h4>
                                                            <a href="{{ route('destination.all', ['province' => $province]) }}" class="btn-hover text-white">
                                                                View All Place <i class="fa fa-arrow-right ms-2"></i>
                                                            </a>
                                                        </a>
                                                    </div>
                                                    <div class="search-icon">
                                                        <a href="{{ $topPlace ? asset('frontend/images/destination-1.jpg') : '#' }}" data-lightbox="destination-1">
                                                            <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <a href="{{ route('destination.all') }}" class="btn btn-primary px-4 py-2">See All Place</a>
                            </div>
                        @endif
                    </div>
                    <div id="tab-usa" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            @if(isset($Places['TP. Hồ Chí Minh']))
                                @foreach($Places['TP. Hồ Chí Minh'] as $Place)
                                    <div class="col-lg-4">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-6.jpg')}}" alt="Image of {{$Place->name}}">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">{{$Place->name}}</h4>
                                                <a href="{{route('destination.detail', $Place->id)}}" class="btn-hover text-white">View detail<i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset('frontend/images/destination-6.jpg')}}" data-lightbox="destination-6"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mt-4">
                        @if(isset($Places['TP. Hồ Chí Minh']))
                            {{ $Places['TP. Hồ Chí Minh']->appends(['tab' => 'usa'])->links() }} <!-- Phân trang chỉ áp dụng cho USA -->
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Payment End -->

        <!-- Explore Tour Start -->
        <div class="container-fluid ExploreTour py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px; margin-top: 10rem;">
                    <h5 class="section-title px-3">Explore Tour</h5>
                    <h1 class="mb-4">The World</h1>
                    <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum tempore nam, architecto doloremque velit explicabo? Voluptate sunt eveniet fuga eligendi! Expedita laudantium fugiat corrupti eum cum repellat a laborum quasi.
                    </p>
                </div>
                <div class="tab-class text-center col-lg-11 col-xl-11 col-xxl-9 mx-auto">
                    <div class="tab-content">
                        <div class="text-start">
                            <h5 class="mb-0" id="destination-title">
                                Most Rating
                            </h5>
                        </div>
                        <div id="NationalTab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                @foreach($topTours as $tour)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="national-item">
                                            <img src="{{ $tour->image ? asset($tour->image) : asset('frontend/images/explore-tour-1.jpg') }}" class="img-fluid w-100 rounded" alt="{{ $tour->name }}">
                                            <div class="national-content">
                                                <div class="national-info">
                                                    <h5 class="text-white text-uppercase mb-2">{{ $tour->name }}</h5>
                                                    <a href="{{ route('tour.detail', $tour->id) }}" class="btn-hover text-white">View Detail <i class="fa fa-arrow-right ms-2"></i></a>
                                                </div>
                                            </div>
                                            @if($tour->discount)
                                                <div class="tour-offer bg-info">{{ $tour->discount }}% Off</div>
                                            @endif
                                            <div class="national-plus-icon">
                                                <a href="{{ route('tour.detail', $tour->id) }}" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if($topTours->isEmpty())
                                    <div class="col-12">
                                        <p class="text-center text-muted">No tours found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Explore Tour End -->



        <!-- Gallery Start -->
        <div class="container-fluid gallery py-5 my-5 w-100">
            <div class="mx-auto text-center mb-5" style="max-width: 900px; margin-top: 10rem;">
                <h5 class="section-title px-3">Our Gallery</h5>
                <h1 class="mb-4">Tourism & Traveling Gallery.</h1>
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum tempore nam, architecto doloremque velit explicabo? Voluptate sunt eveniet fuga eligendi! Expedita laudantium fugiat corrupti eum cum repellat a laborum quasi.
                </p>
            </div>
            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#GalleryTab-1">
                            <span class="text-dark" style="width: 150px;">All</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#GalleryTab-4">
                            <span class="text-dark" style="width: 150px;">Summer Tour</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#GalleryTab-5">
                            <span class="text-dark" style="width: 150px;">Sport Tour</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content  w-100">
                    <div id="GalleryTab-1" class="tab-pane fade show p-0 active  w-100">
                        <div class="row g-2  w-100">
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-1.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-1.jpg")}}" data-lightbox="gallery-1" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-2.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-2.jpg")}}" data-lightbox="gallery-2" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-3.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-3.jpg")}}" data-lightbox="gallery-3" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-4.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-4.jpg")}}" data-lightbox="gallery-4" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-5.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-5.jpg")}}" data-lightbox="gallery-5" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-6.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-6.jpg")}}" data-lightbox="gallery-6" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-7.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-7.jpg")}}" data-lightbox="gallery-7" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-8.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-8.jpg")}}" data-lightbox="gallery-8" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-9.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-9.jpg")}}" data-lightbox="gallery-9" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-10.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-10.jpg")}}" data-lightbox="gallery-10" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GalleryTab-2" class="tab-pane fade show p-0">
                        <div class="row g-2">
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-2.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-2.jpg")}}" data-lightbox="gallery-2" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-3.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-3.jpg")}}" data-lightbox="gallery-3" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GalleryTab-3" class="tab-pane fade show p-0">
                        <div class="row g-2">
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-2.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-2.jpg")}}" data-lightbox="gallery-2" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-3.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-3.jpg")}}" data-lightbox="gallery-3" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GalleryTab-4" class="tab-pane fade show p-0">
                        <div class="row g-2">
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-2.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-2.jpg")}}" data-lightbox="gallery-2" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-3.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-3.jpg")}}" data-lightbox="gallery-3" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="GalleryTab-5" class="tab-pane fade show p-0">
                        <div class="row g-2">
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-2.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-2.jpg")}}" data-lightbox="gallery-2" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                                <div class="gallery-item h-100">
                                    <img src="{{asset("frontend/images/gallery-3.jpg")}}" class="img-fluid w-100 h-100 rounded" alt="Image">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                            <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{asset("frontend/images/gallery-3.jpg")}}" data-lightbox="gallery-3" class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery End -->

        <!-- Tour Product Start -->
        <div class="container-fluid booking py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h5 class="section-booking-title pe-3">Booking</h5>
                        <h1 class="text-white mb-4">Online Booking</h1>
                        <p class="text-white mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur maxime ullam esse fuga blanditiis accusantium pariatur quis sapiente, veniam doloribus praesentium? Repudiandae iste voluptatem fugiat doloribus quasi quo iure officia.
                        </p>
                        <p class="text-white mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur maxime ullam esse fuga blanditiis accusantium pariatur quis sapiente, veniam doloribus praesentium? Repudiandae iste voluptatem fugiat doloribus quasi quo iure officia.
                        </p>
                        <a href="#" class="btn btn-light text-primary rounded-pill py-3 px-5 mt-2">Read More</a>
                    </div>
                    <div class="col-lg-6">
                        <h1 class="text-white mb-3">Book A Tour Deals</h1>
                        <p class="text-white mb-4">Get <span class="text-warning">50% Off</span> On Your First Adventure Trip With Travela. Get More Deal Offers Here.</p>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-white border-0" id="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-white border-0" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control bg-white border-0" id="datetime" placeholder="Date & Time" data-target="#date3" data-toggle="datetimepicker" />
                                        <label for="datetime">Date & Time</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select bg-white border-0" id="select1">
                                            <option value="1">Destination 1</option>
                                            <option value="2">Destination 2</option>
                                            <option value="3">Destination 3</option>
                                        </select>
                                        <label for="select1">Destination</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select bg-white border-0" id="SelectPerson">
                                            <option value="1">Persons 1</option>
                                            <option value="2">Persons 2</option>
                                            <option value="3">Persons 3</option>
                                        </select>
                                        <label for="SelectPerson">Persons</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select bg-white border-0" id="CategoriesSelect">
                                            <option value="1">Kids</option>
                                            <option value="2">1</option>
                                            <option value="3">2</option>
                                            <option value="3">3</option>
                                        </select>
                                        <label for="CategoriesSelect">Categories</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control bg-white border-0" placeholder="Special Request" id="message" style="height: 100px"></textarea>
                                        <label for="message">Special Request</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary text-white w-100 py-3" type="submit">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tour Product End -->

        <!-- Travel Guide Start -->
        <div class="container-fluid guide py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px; margin-top: 10rem;">
                    <h5 class="section-title px-3">Travel Guide</h5>
                    <h1 class="mb-0">Meet Our Guide</h1>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="{{asset("frontend/images/guide-1.jpg")}}" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>
                                <div class="guide-icon rounded-pill p-2">
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="guide-title text-center rounded-bottom p-4">
                                <div class="guide-title-inner">
                                    <h4 class="mt-3">Full Name</h4>
                                    <p class="mb-0">Designation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="{{asset("frontend/images/guide-2.jpg")}}" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>
                                <div class="guide-icon rounded-pill p-2">
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="guide-title text-center rounded-bottom p-4">
                                <div class="guide-title-inner">
                                    <h4 class="mt-3">Full Name</h4>
                                    <p class="mb-0">Designation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="{{asset("frontend/images/guide-3.jpg")}}" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>
                                <div class="guide-icon rounded-pill p-2">
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="guide-title text-center rounded-bottom p-4">
                                <div class="guide-title-inner">
                                    <h4 class="mt-3">Full Name</h4>
                                    <p class="mb-0">Designation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="{{asset("frontend/images/guide-4.jpg")}}" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>
                                <div class="guide-icon rounded-pill p-2">
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="guide-title text-center rounded-bottom p-4">
                                <div class="guide-title-inner">
                                    <h4 class="mt-3">Full Name</h4>
                                    <p class="mb-0">Designation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Travel Guide End -->

        <!-- Testimonial Start -->
{{--        <div class="container-fluid testimonial py-5">--}}
{{--            <div class="container py-5">--}}
{{--                <div class="mx-auto text-center mb-5" style="max-width: 900px;">--}}
{{--                    <h5 class="section-title px-3">Testimonial</h5>--}}
{{--                    <h1 class="mb-0">Our Clients Say!!!</h1>--}}
{{--                </div>--}}
{{--                <div class="testimonial-carousel owl-carousel">--}}
{{--                    <div class="testimonial-item text-center rounded pb-4">--}}
{{--                        <div class="testimonial-comment bg-light rounded p-4">--}}
{{--                            <p class="text-center mb-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis nostrum cupiditate, eligendi repellendus saepe illum earum architecto dicta quisquam quasi porro officiis. Vero reiciendis,--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <div class="testimonial-img p-1">--}}
{{--                            <img src="{{asset("frontend/images/testimonial-1.jpg")}}" class="img-fluid rounded-circle" alt="Image">--}}
{{--                        </div>--}}
{{--                        <div style="margin-top: -35px;">--}}
{{--                            <h5 class="mb-0">John Abraham</h5>--}}
{{--                            <p class="mb-0">New York, USA</p>--}}
{{--                            <div class="d-flex justify-content-center">--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="testimonial-item text-center rounded pb-4">--}}
{{--                        <div class="testimonial-comment bg-light rounded p-4">--}}
{{--                            <p class="text-center mb-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis nostrum cupiditate, eligendi repellendus saepe illum earum architecto dicta quisquam quasi porro officiis. Vero reiciendis,--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <div class="testimonial-img p-1">--}}
{{--                            <img src="{{asset("frontend/images/testimonial-2.jpg")}}" class="img-fluid rounded-circle" alt="Image">--}}
{{--                        </div>--}}
{{--                        <div style="margin-top: -35px;">--}}
{{--                            <h5 class="mb-0">John Abraham</h5>--}}
{{--                            <p class="mb-0">New York, USA</p>--}}
{{--                            <div class="d-flex justify-content-center">--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="testimonial-item text-center rounded pb-4">--}}
{{--                        <div class="testimonial-comment bg-light rounded p-4">--}}
{{--                            <p class="text-center mb-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis nostrum cupiditate, eligendi repellendus saepe illum earum architecto dicta quisquam quasi porro officiis. Vero reiciendis,--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <div class="testimonial-img p-1">--}}
{{--                            <img src="{{asset("frontend/images/testimonial-3.jpg")}}" class="img-fluid rounded-circle" alt="Image">--}}
{{--                        </div>--}}
{{--                        <div style="margin-top: -35px;">--}}
{{--                            <h5 class="mb-0">John Abraham</h5>--}}
{{--                            <p class="mb-0">New York, USA</p>--}}
{{--                            <div class="d-flex justify-content-center">--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="testimonial-item text-center rounded pb-4">--}}
{{--                        <div class="testimonial-comment bg-light rounded p-4">--}}
{{--                            <p class="text-center mb-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis nostrum cupiditate, eligendi repellendus saepe illum earum architecto dicta quisquam quasi porro officiis. Vero reiciendis,--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <div class="testimonial-img p-1">--}}
{{--                            <img src="{{asset("frontend/images/testimonial-4.jpg")}}" class="img-fluid rounded-circle" alt="Image">--}}
{{--                        </div>--}}
{{--                        <div style="margin-top: -35px;">--}}
{{--                            <h5 class="mb-0">John Abraham</h5>--}}
{{--                            <p class="mb-0">New York, USA</p>--}}
{{--                            <div class="d-flex justify-content-center">--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                                <i class="fas fa-star text-primary"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- Testimonial End -->

        <!-- Subscribe Start -->
        <div class="container-fluid subscribe py-5">
            <div class="container text-center py-5">
                <div class="mx-auto text-center" style="max-width: 900px; margin-top: 10rem;">
                    <h5 class="subscribe-title px-3">Subscribe</h5>
                    <h1 class="text-white mb-4">Our Newsletter</h1>
                    <p class="text-white mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum tempore nam, architecto doloremque velit explicabo? Voluptate sunt eveniet fuga eligendi! Expedita laudantium fugiat corrupti eum cum repellat a laborum quasi.
                    </p>
                    <div class="position-relative mx-auto">
                        <input class="form-control border-primary rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Subscribe End -->

        <!-- Footer Start -->
        <div class="container-fluid footer py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Get In Touch</h4>
                            <a href=""><i class="fas fa-home me-2"></i> 123 Street, New York, USA</a>
                            <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                            <a href=""><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                            <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +012 345 67890</a>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-share fa-2x text-white me-2"></i>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Company</h4>
                            <a href=""><i class="fas fa-angle-right me-2"></i> About</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Careers</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Blog</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Press</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Gift Cards</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Magazine</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Support</h4>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Contact</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Legal Notice</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Terms and Conditions</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Sitemap</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Cookie policy</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <div class="row gy-3 gx-2 mb-4">
                                <div class="col-xl-6">
                                    <form>
                                        <div class="form-floating">
                                            <select class="form-select bg-dark border" id="select1">
                                                <option value="1">Arabic</option>
                                                <option value="2">German</option>
                                                <option value="3">Greek</option>
                                                <option value="3">New York</option>
                                            </select>
                                            <label for="select1">English</label>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-6">
                                    <form>
                                        <div class="form-floating">
                                            <select class="form-select bg-dark border" id="select1">
                                                <option value="1">USD</option>
                                                <option value="2">EUR</option>
                                                <option value="3">INR</option>
                                                <option value="3">GBP</option>
                                            </select>
                                            <label for="select1">$</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <h4 class="text-white mb-3">Payments</h4>
                            <div class="footer-bank-card">
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-amex fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-visa fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fas fa-credit-card fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-mastercard fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-paypal fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-cc-discover fa-2x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Chatbot -->
        @include('.frontend.component.chatbot')
        <!-- Chatbot End -->


        <!-- Copyright Start -->
        <div class="container-fluid copyright text-body py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-end mb-md-0">
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-start">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
        {{--        </div>--}}
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>

@endsection
