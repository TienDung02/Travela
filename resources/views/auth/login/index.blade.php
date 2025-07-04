@extends('frontend.layouts.layout')
@section('content')

    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Travela</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            @include('frontend.component.menu-top')
        </nav>

        <!-- Carousel Start -->
        <div class="carousel-header">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="w-100 p-5 m-auto position-fixed" style="z-index: 999; margin-top: 10rem !important;">
                        <div class="row justify-content-center w-75 m-auto ">
                            <div class="col-md-6">
                                <div class="card p-5">
                                    <div class="card-header text-center">
                                        <h3>Đăng Nhập</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('login.login')}}" method="POST"  id="loginForm">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control password" id="password" name="password" required>
                                            </div>
                                            <div class="notification-limit notice closeable d-none form p-2 bg-white rounded">
                                                <p class="text-center"><span class="text-danger">Password minimum 8 characters</span></p>
                                            </div>

                                            <button type="submit" class="btn btn-primary w-100 btn-submit-update">Đăng Nhập</button>
                                        </form>

                                        <hr>
                                        <p class="text-center">Hoặc đăng nhập bằng</p>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{route('google.login')}}" class="btn btn-danger me-2">
                                                <i class="bi bi-google"></i> Google
                                            </a>
                                            <a href="{{route('facebook.login')}}" class="btn btn-primary">
                                                <i class="bi bi-facebook"></i> Facebook
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="carousel-item active">
                        <img src="{{asset("frontend/images/carousel-2.jpg")}}" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('frontend/images/carousel-1.jpg')}}" class="img-fluid" alt="Image">
                        <div class="p-3" style="max-width: 900px;">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('frontend/images/carousel-3.jpg')}}" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Carousel End -->

    </div>
@endsection



