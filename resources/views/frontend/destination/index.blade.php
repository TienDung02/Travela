@extends('frontend.layouts.layout')
@section('content')


    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="m-0">
                    <img src="{{asset('frontend/images/logo2.png')}}" alt="Logo">
                    Travela</h1>
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
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4">Travel Destination</h3>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Destination</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Destination Start -->
    <div class="container-fluid destination py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Destination</h5>
            </div>
            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-all" data-tab="all">
                            <span class="text-dark" style="width: 150px;">All</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-usa" data-tab="usa">
                            <span class="text-dark" style="width: 150px;">USA</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-canada"
                        data-tab="canada">
                            <span class="text-dark" style="width: 150px;">Canada</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-europe"
                        data-tab="europe">
                            <span class="text-dark" style="width: 150px;">Europe</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-china"
                        data-tab="china">
                            <span class="text-dark" style="width: 150px;">China</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-singapore"
                        data-tab="singapore">
                            <span class="text-dark" style="width: 150px;">Singapore</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-all" class="tab-pane fade show p-0 active">
                        <div id="destination-container" class="row g-4">
                            <div class="col-xl-12">
                                <div class="row g-4">
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-1.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">USA</h4>
                                                <a data-toggle-tab="usa" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset("frontend/images/destination-1.jpg")}}" data-lightbox="destination-1"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-2.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">Canada</h4>
                                                <a data-toggle-tab="canada" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset("frontend/images/destination-2.jpg")}}" data-lightbox="destination-2"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-7.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">Europe</h4>
                                                <a data-toggle-tab="europe" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset("frontend/images/destination-7.jpg")}}" data-lightbox="destination-7"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-8.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">China</h4>
                                                <a data-toggle-tab="china" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset('frontend/images/destination-8.jpg')}}" data-lightbox="destination-8"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-8.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">Singapore</h4>
                                                <a data-toggle-tab="singapore" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset('frontend/images/destination-9.jpg')}}" data-lightbox="destination-4"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-1.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">USA</h4>
                                                <a data-toggle-tab="usa" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset("frontend/images/destination-1.jpg")}}" data-lightbox="destination-1"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-2.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">Canada</h4>
                                                <a data-toggle-tab="canada" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset("frontend/images/destination-2.jpg")}}" data-lightbox="destination-2"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-7.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">Europe</h4>
                                                <a data-toggle-tab="europe" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset("frontend/images/destination-7.jpg")}}" data-lightbox="destination-7"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-8.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">China</h4>
                                                <a data-toggle-tab="china" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset('frontend/images/destination-8.jpg')}}" data-lightbox="destination-8"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-8.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">Singapore</h4>
                                                <a data-toggle-tab="singapore" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset('frontend/images/destination-9.jpg')}}" data-lightbox="destination-4"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-1.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">USA</h4>
                                                <a data-toggle-tab="usa" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset("frontend/images/destination-1.jpg")}}" data-lightbox="destination-1"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-2.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">Canada</h4>
                                                <a data-toggle-tab="canada" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset("frontend/images/destination-2.jpg")}}" data-lightbox="destination-2"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-7.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">Europe</h4>
                                                <a data-toggle-tab="europe" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset("frontend/images/destination-7.jpg")}}" data-lightbox="destination-7"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-8.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">China</h4>
                                                <a data-toggle-tab="china" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset('frontend/images/destination-8.jpg')}}" data-lightbox="destination-8"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-8.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">Singapore</h4>
                                                <a data-toggle-tab="singapore" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset('frontend/images/destination-9.jpg')}}" data-lightbox="destination-4"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-1.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">USA</h4>
                                                <a data-toggle-tab="usa" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset("frontend/images/destination-1.jpg")}}" data-lightbox="destination-1"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-2.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">Canada</h4>
                                                <a data-toggle-tab="canada" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset("frontend/images/destination-2.jpg")}}" data-lightbox="destination-2"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-7.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">Europe</h4>
                                                <a data-toggle-tab="europe" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset("frontend/images/destination-7.jpg")}}" data-lightbox="destination-7"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-8.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">China</h4>
                                                <a data-toggle-tab="china" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset('frontend/images/destination-8.jpg')}}" data-lightbox="destination-8"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 destination-item">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-8.jpg')}}" alt="">
                                            <div class="destination-overlay p-4">
                                                <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                                <h4 class="text-white mb-2 mt-3">Singapore</h4>
                                                <a data-toggle-tab="singapore" href="#" data-bs-toggle="pill" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{asset('frontend/images/destination-9.jpg')}}" data-lightbox="destination-4"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul id="pagination" class="pagination justify-content-center mt-4"></ul>
                        </nav>
                    </div>
                    <div id="tab-usa" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            @foreach($Places['USA'] as $Place)
                                <div class="col-lg-4">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="{{asset('frontend/images/destination-6.jpg')}}" alt="Image of {{$Place->name}}">
                                        <div class="destination-overlay p-4">
                                            <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photosssssssssssssssssss</a>
                                            <h4 class="text-white mb-2 mt-3">{{$Place->name}}</h4>
                                            <a href="{{route('destination.detail', $Place->id)}}" class="btn-hover text-white">View detail<i class="fa fa-arrow-right ms-2"></i></a>
                                        </div>
                                        <div class="search-icon">
                                            <a href="{{asset('frontend/images/destination-6.jpg')}}" data-lightbox="destination-6"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            {{ $Places['USA']->appends(['tab' => 'usa'])->links() }} <!-- Phân trang chỉ áp dụng cho USA -->
                        </div>
                    </div>
                    <div id="tab-canada" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            @foreach($Places['Canada'] as $Place) <!-- Chỉ hiển thị địa điểm của USA -->
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
                        </div>
                        <div class="mt-4">
                            {{ $Places['Canada']->appends(['tab' => 'canada'])->links() }} <!-- Phân trang chỉ áp dụng cho USA -->
                        </div>
                    </div>
                    <div id="tab-europe" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            @foreach($Places['Europe'] as $Place) <!-- Chỉ hiển thị địa điểm của USA -->
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
                        </div>
                        <div class="mt-4">
                            {{ $Places['Europe']->appends(['tab' => 'europe'])->links() }} <!-- Phân trang chỉ áp dụng cho USA -->
                        </div>
                    </div>
                    <div id="tab-china" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            @foreach($Places['China'] as $Place) <!-- Chỉ hiển thị địa điểm của USA -->
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
                        </div>
                        <div class="mt-4">
                            {{ $Places['China']->appends(['tab' => 'china'])->links() }} <!-- Phân trang chỉ áp dụng cho USA -->
                        </div>
                    </div>
                    <div id="tab-singapore" class="tab-pane fade show p-0">
                        <div class="row g-4">
                                @foreach($Places['Singapore'] as $Place) <!-- Chỉ hiển thị địa điểm của USA -->
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
                            </div>
                            <div class="mt-4">
                                {{ $Places['Singapore']->appends(['tab' => 'singapore'])->links() }} <!-- Phân trang chỉ áp dụng cho USA -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Destination End -->

        <!-- Subscribe Start -->
        <div class="container-fluid subscribe py-5">
            <div class="container text-center py-5">
                <div class="mx-auto text-center" style="max-width: 900px;">
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
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>
    <script>
document.addEventListener('DOMContentLoaded', () => {
  const defaultTab = 'all';
  const url = new URL(window.location.href);
  const urlParams = url.searchParams;

  // ─── 1) XỬ LÝ TAB ───────────────────────────────────
  let currentTab = urlParams.get('tab');
  if (performance.navigation.type === performance.navigation.TYPE_RELOAD || !currentTab) {
    currentTab = defaultTab;
    urlParams.set('tab', defaultTab);
    urlParams.set('page', '1');
    window.history.replaceState(null, '', url.toString());
  }
  // show đúng tab
  const activeTab = document.querySelector(`.nav-pills a[data-tab="${currentTab}"]`);
  if (activeTab) new bootstrap.Tab(activeTab).show();

  // click tab, reset page→1
  document.querySelectorAll('.nav-pills a[data-tab]').forEach(tab => {
    tab.addEventListener('click', e => {
      e.preventDefault();
      const t = tab.getAttribute('data-tab');
      urlParams.set('tab', t);
      urlParams.set('page', '1');
      window.location.href = url.toString();
    });
  });
  // “View All Place” overlay cũng tương tự
  document.querySelectorAll('[data-toggle-tab]').forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      const t = btn.getAttribute('data-toggle-tab');
      urlParams.set('tab', t);
      urlParams.set('page', '1');
      window.location.href = url.toString();
    });
  });
  window.addEventListener('popstate', () => {
    const p = new URLSearchParams(window.location.search);
    const t = p.get('tab') || defaultTab;
    const link = document.querySelector(`.nav-pills a[data-tab="${t}"]`);
    if (link) new bootstrap.Tab(link).show();
  });

  // ─── 2) XỬ LÝ PAGINATION ─────────────────────────────
  const container    = document.getElementById('destination-container');
  const items        = Array.from(container.querySelectorAll('.destination-item'));
  const paginationEl = document.getElementById('pagination');
  const itemsPerPage = 9;
  const totalPages   = Math.ceil(items.length / itemsPerPage);

  // Lấy page hiện tại từ URL, mặc định 1
  let currentPage = parseInt(urlParams.get('page')) || 1;
  currentPage = Math.min(Math.max(currentPage, 1), totalPages);

  function showPage(page) {
    currentPage = page;
    // Ẩn/hiện item
    const start = (page - 1) * itemsPerPage;
    const end   = start + itemsPerPage;
    items.forEach((el, i) => {
      el.style.display = (i >= start && i < end) ? '' : 'none';
    });
    // Cập nhật URL mà không reload
    urlParams.set('page', page);
    window.history.replaceState(null, '', url.toString());
    renderPagination();
  }

  function renderPagination() {
    paginationEl.innerHTML = '';
    const makeLi = (p, label, opts={active:false,disabled:false}) => {
      const li = document.createElement('li');
      li.className = 'page-item' + (opts.active? ' active':'') + (opts.disabled?' disabled':'');
      const a = document.createElement('a');
      a.className = 'page-link';
      a.href = '#';
      a.textContent = label;
      if (!opts.active && !opts.disabled) {
        a.addEventListener('click', e => {
          e.preventDefault();
          showPage(p);
        });
      }
      li.appendChild(a);
      return li;
    };
    // Prev
    paginationEl.appendChild(makeLi(currentPage-1, '‹', {disabled: currentPage===1}));
    // Các nút số (tối đa 9 nút hiển thị)
    const maxButtons = 9;
    if (totalPages <= maxButtons) {
      for (let i=1; i<= totalPages; i++) {
        paginationEl.appendChild(makeLi(i, i, {active: i===currentPage}));
      }
    } else {
      const half = Math.floor(maxButtons/2);
      let start = Math.max(1, currentPage - half);
      let end   = Math.min(totalPages, currentPage + half);
      if (currentPage <= half)       end = maxButtons;
      else if (currentPage + half > totalPages) start = totalPages - maxButtons + 1;

      if (start > 1) {
        paginationEl.appendChild(makeLi(1, '1'));
        if (start > 2) paginationEl.appendChild(makeLi(null, '…', {disabled: true}));
      }
      for (let i=start; i<=end; i++) {
        paginationEl.appendChild(makeLi(i, i, {active: i===currentPage}));
      }
      if (end < totalPages) {
        if (end < totalPages -1) paginationEl.appendChild(makeLi(null, '…', {disabled: true}));
        paginationEl.appendChild(makeLi(totalPages, totalPages));
      }
    }
    // Next
    paginationEl.appendChild(makeLi(currentPage+1, '›', {disabled: currentPage===totalPages}));
  }

  // Khởi tạo hiển thị
  showPage(currentPage);
});
</script>




@endsection
