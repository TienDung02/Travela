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
                                        <h3>Đăng Ký</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('auth.reg')}}" method="POST" class="reg">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="name" class="form-label">User name</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
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
                                            <div class="mb-3">
                                                <label for="password" class="form-label ">Confirm Password</label>
                                                <input type="password" class="form-control confirm_password" id="confirm_password" name="password_confirmation" required>
                                            </div>
                                            <div class="notification notice closeable form p-2 d-none bg-white rounded">
                                                <p class="text-center"><span class="text-danger">Confirm password does not match</span></p>
                                            </div>

                                            <button type="submit" class="btn btn-primary w-100 btn-submit-update">Đăng Ký</button>
                                        </form>

                                        <hr>
                                        <p class="text-center">Hoặc đăng nhập bằng</p>
                                        <div class="d-flex justify-content-center">
                                            <a href="YOUR_GOOGLE_LOGIN_URL" class="btn btn-danger me-2">
                                                <i class="bi bi-google"></i> Google
                                            </a>
                                            <a href="YOUR_FACEBOOK_LOGIN_URL" class="btn btn-primary">
                                                <i class="bi bi-facebook"></i> Facebook
                                            </a>
                                        </div>
                                    </div>
                                    <p class="mt-3 text-center">
                                        Đã có tài khoản? <a href="{{route('login.index')}}">Đăng nhập</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="carousel-item active">
                        <img src="{{asset("images/carousel-2.jpg")}}" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px;">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('images/carousel-1.jpg')}}" class="img-fluid" alt="Image">
                        <div class="p-3" style="max-width: 900px;">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('images/carousel-3.jpg')}}" class="img-fluid" alt="Image">
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



