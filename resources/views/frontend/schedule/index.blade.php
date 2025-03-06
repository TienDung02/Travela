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
    <div class="container-fluid bg-breadcrumb" style="background: linear-gradient(rgba(19, 53, 123, 0.5), rgba(19, 53, 123, 0.5)), url({{ asset('images/breadcrumb-bg.jpg') }});">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h1 class="text-white display-3 mb-4">Contact Us</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Contact</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Contact Start -->
    <div class="container-fluid contact bg-light py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Build schedule</h5>
                <h1 class="mb-0">Build Your Schedule</h1>
            </div>
            <div class="row g-5 align-items-stretch">
                <div class="col-lg-4 image-left-schedule">
                    <div class="rounded h-100 p-4 position-relative d-flex flex-column">
                        <div class="text-start w-75 position-absolute top-0 start-0">
                            <img src="{{asset('images/destination-1.jpg')}}" alt="">
                        </div>
                        <div class="text-end w-75 position-absolute end-0" style="    transform: translateY(65%) !important;">
                            <img src="{{asset('images/destination-2.jpg')}}" alt="">
                        </div>
                        <div class="text-center w-75 position-absolute bottom-0">
                            <img src="{{asset('images/destination-3.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <h3 class="mb-2">Enter trip information</h3>
                    <form action="{{ route('map') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="address" class="form-control" placeholder="Nhập địa điểm..." required>
                            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                        </div>
                    </form>
                    <form>
                        <div class="row g-3">
                            <div class="col-12">

                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control border-0" id="subject" placeholder="">
                                    <label for="subject">Where do you want to go ?</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control border-0" id="name" placeholder="">
                                    <label for="name">Departure date</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control border-0" id="email" placeholder="">
                                    <label for="email">Return date</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <input type="email" class="form-control border-0" id="email" placeholder="">
                                    <label for="email">Budget</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select class="form-control bg-white border-0">
                                        @foreach($currencies as $currency)
                                            <option>{{$currency->country}} - {{$currency->code }}</option>
                                        @endforeach
                                    </select>
                                    <label for="email">Currency</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="number" class="form-control border-0" id="email" placeholder="">
                                            <label for="email">Adults > 10 years old</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="number" class="form-control border-0" id="email" placeholder="">
                                            <label for="email">Children 2 - 10 years old</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="number" class="form-control border-0" id="email" placeholder="">
                                            <label for="email">Children < 2 years old</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control border-0" id="email" placeholder="">
                                    <label for="email">Interest</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Create a schedule now</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            @if(isset($weather))
            <div class="mt-5 row bg-white rounded" style="height: 68rem">

                    <h2 class="text-center mt-4 mb-3">{{ $weather['location']['name'] }}, {{ $weather['location']['country'] }}</h2>
                    <hr>
                <div class="col-lg-7 ps-4 pb-3">
                    <div class="weather">
                        @if(isset($error))
                            <p style="color: red;">{{ $error }}</p>
                        @else

                            @if(isset($weather['forecast']) && isset($weather['forecast']['forecastday']))
                                <ul class="row">
                                    @foreach($weather['forecast']['forecastday'] as $day)
                                        <li class="col-lg-4">
                                            <strong style="color: #0b204a">{{ \Carbon\Carbon::parse($day['date'])->format('d/m/Y') }}</strong>
                                            <p><strong>Temperature:</strong> {{ $day['day']['avgtemp_c'] }}°C</p>
                                            <p><strong>Humidity:</strong> {{ $day['day']['avghumidity'] }}%</p>
                                            <p><strong>Wind speed:</strong> {{ $day['day']['maxwind_kph'] }} km/h</p>
                                            <p><strong>Status:</strong> {{ $day['day']['condition']['text'] }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Không có dữ liệu dự báo thời tiết.</p>
                            @endif
                        @endif
                    </div>
                    <div>
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
                                        <img src="{{asset("images/carousel-2.jpg")}}" class="img-fluid" alt="Image">
                                        <div class="carousel-caption">
                                            <div class="p-3" style="max-width: 900px; margin-top: 10rem;">
                                                <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                                                <h1 class="display-2 text-capitalize text-white mb-4">Let's The World Together!</h1>
                                                <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                                </p>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="{{route('schedule.index')}}">Discover Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{asset('images/carousel-1.jpg')}}" class="img-fluid" alt="Image">
                                        <div class="carousel-caption">
                                            <div class="p-3" style="max-width: 900px; margin-top: 10rem;">
                                                <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                                                <h1 class="display-2 text-capitalize text-white mb-4">Find Your Perfect Tour At Travel</h1>
                                                <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                                </p>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="{{route('schedule.index')}}">Discover Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{asset('images/carousel-3.jpg')}}" class="img-fluid" alt="Image">
                                        <div class="carousel-caption">
                                            <div class="p-3" style="max-width: 900px; margin-top: 10rem;">
                                                <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                                                <h1 class="display-2 text-capitalize text-white mb-4">You Like To Go?</h1>
                                                <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                                </p>
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
                </div>
                <div class="col-lg-5 p-0">
                    @if(isset($error))
                        <div class="alert alert-danger">{{ $error }}</div>
                    @elseif(isset($data))
                        <div class="card border-start-0 border-0">
                            <div class="card-body pt-0">
{{--                                <h4 class="card-title">{{ $data['formatted_address'] }}</h4>--}}
                                <div id="map" style="width: 100%; height: 61rem;"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endif
                
        </div>
    </div>
    <!-- Contact End -->

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
                    Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>

    @if(isset($data))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var map = L.map('map').setView([{{ $data['geometry']['location']['lat'] }}, {{ $data['geometry']['location']['lng'] }}], 14);

                // Thêm tile từ OpenStreetMap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                // Thêm marker vào vị trí
                L.marker([{{ $data['geometry']['location']['lat'] }}, {{ $data['geometry']['location']['lng'] }}])
                    .addTo(map)
                    .bindPopup('{{ $data['formatted_address'] }}')
                    .openPopup();
            });
        </script>

    @endif

@endsection
