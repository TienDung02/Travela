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
    <div class="container-fluid bg-breadcrumb p-b-100" style="background: linear-gradient(rgba(19, 53, 123, 0.5), rgba(19, 53, 123, 0.5)), url({{ asset('frontend/images/breadcrumb-bg.jpg') }});">
        <div class="container-fluid text-center py-5" style="max-width: 900px;">
        </div>
    </div>
    <!-- Header End -->

    <!-- Contact Start -->
    <div class="container-fluid contact bg-light py-5 position-relative min-h-100vh">
        <div class="p-0 container position-absolute rounded" style="background-color: rgb(242, 242, 242) !important; left: 50%;transform: translate(-50%, -20%);">
            <div class=" row d-flex bg-white pt-4 rounded w-100 m-auto">
                <div class=" d-flex justify-content-end col-2">
                    <img class="avatar-user" src="{{$user->avatar}}" alt="">
                </div>
                <div class=" d-flex flex-column justify-content-center col-8">
                    <h1 class="ps-3">{{$user->fullname}}</h1>
                    <h2 class="
                         @if($user->rank == 'Bronze')
                            bg-bronze
                        @elseif($user->rank == 'Silver')
                            bg-silver
                        @elseif($user->rank == 'Gold')
                            bg-gold
                        @elseif($user->rank == 'Platinum')
                            bg-platinum
                        @else
                            bg-diamond
                        @endif
                         rounded w-30 p-3 cursor-pointer ms-3 mt-2 text-rank text-white">Member rank {{$user->rank}} <i class="fa-solid fa-medal"></i></h2>
                </div>
                <div class="mx-auto text-center mb-5 col-2 align-items-center d-flex">
                    <a class="p-3  border rounded"><h4 class="p-0 m-0">Edit profile &nbsp; <i class="fa-solid fa-gear"></i></h4></a>
                </div>
                <div class="mx-auto text-center mb-2 col-12">
                    <ol class="menu-profile nav nav-tabs" id="profileTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab">Activity feed</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab">Trips</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab">Photo</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button" role="tab">Reviews</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab5-tab" data-bs-toggle="tab" data-bs-target="#tab5" type="button" role="tab">Travel map</button>
                        </li>
                    </ol>

                </div>
            </div>
            <div class="row mt-3 w-100 m-auto">
                <div class="col-lg-3 p-0">
                    <div class="bg-white rounded p-4">
                        <h4 class="ms-2 mb-4">
                            About You
                        </h4>
                        <div class="text-center mb-4 ms-3 d-flex align-items-center">
                            <i class="fa fa-map-marker-alt fa-2x text-primary"></i>
                            <p class="ms-3 mb-0">{{$address}}</p>
                        </div>
                        <div class="text-center mb-4 ms-3 d-flex align-items-center">
                            <i class="fa fa-phone-alt fa-2x text-primary "></i>
                            <p class="ms-3 mb-0">{{$user->phone}}</p>
                        </div>
                        <div class="text-center mb-4 ms-3 d-flex align-items-center">
                            <i class="fa fa-user fa-2x text-primary "></i>
                            <p class="ms-3 mb-0">{{$user->gender}}</p>
                        </div>
                        <div class="text-center mb-4 ms-3 d-flex align-items-center">
                            <i class="fa-solid fa-cake-candles fa-2x text-primary"></i>
                            <p class="ms-3 mb-0">{{$user->dob}}</p>
                        </div>
                        <div class="text-center mb-4 ms-3 d-flex align-items-center">
                            <i class="fa fa-envelope-open fa-2x text-primary"></i>
                            <p class="ms-3 mb-0">{{$user->email}}</p>
                        </div>
                        <div class="text-center mb-4 ms-3 d-flex align-items-center">
                            <i class="fa-solid fa-plus fa-2x text-primary"></i>
                            <p class="ms-3 mb-0">+012 345 67890</p>
                        </div>
                    </div>
                    <div class="bg-white rounded p-4 mt-3">
                        <h4 class="ms-2 mb-4">
                            Share your travel advice
                        </h4>
                        <div class="text-center mb-4 ms-3 d-flex align-items-center">
                            <i class="fa-solid fa-pen-nib fa-2x text-primary"></i>
                            <p class="ms-3 mb-0">Write article</p>
                        </div>
                        <div class="text-center mb-4 ms-3 d-flex align-items-center">
                            <i class="fa-solid fa-camera fa-2x text-primary "></i>
                            <p class="ms-3 mb-0">Post photos</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 p-0">
                    <div class="bg-white rounded p-4 ms-2">
                        <div class="text-center tab1 mb-4">
                            <div class="tab-content" id="profileTabContent">
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                    <p>Nội dung của Activity feed</p>
                                </div>
                                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                    <p>Nội dung của Trips</p>
                                </div>
                                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                    <p>Nội dung của Photo</p>
                                </div>
                                <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                                    <p>Nội dung của Reviews</p>
                                </div>
                                <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                                    <p>Nội dung của Travel map</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>


@endsection
