@extends('frontend.layouts.layout')
@section('content')

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        @include('frontend.component.navbar')
    </div>
    <!-- Navbar & Hero End -->

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb" style="background: linear-gradient(rgba(19, 53, 123, 0.5), rgba(19, 53, 123, 0.5)), url({{ asset('frontend/images/breadcrumb-bg.jpg') }});">
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
                <div class="col-xl-4 col-md-0 image-left-schedule">
                    <div class="rounded h-100 p-4 position-relative d-flex flex-column">
                        <div class="text-start w-75 position-absolute top-0 start-0">
                            <img src="{{asset('frontend/images/destination-1.jpg')}}" alt="">
                        </div>
                        <div class="text-end w-75 position-absolute end-0" style="    transform: translateY(50%) !important;">
                            <img src="{{asset('frontend/images/destination-2.jpg')}}" alt="">
                        </div>
                        <div class="text-center w-75 position-absolute bottom-0">
                            <img src="{{asset('frontend/images/destination-3.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-md-12">
                    <h3 class="mb-2">Enter trip information</h3>
                    <form action="{{ route('map') }}" method="GET" class="">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" id="searchInput" name="address" class="form-control border-0" autocomplete="off" placeholder="Nhập địa điểm..." required>
                                    <label for="searchInput">Where do you want to go ?</label>
                                    <div class="dropdown">
                                        <div id="results" class="dropdown-menu rounded-bottom rounded-0 w-100 p-0"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <input type="date" class="form-control border-0" id="start_date" name="start_date" placeholder="">
                                    <label for="start_date">Departure date</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <input type="date" class="form-control border-0" id="end_date" name="end_date" placeholder="">
                                    <label for="end_date">Return date</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <select class="form-control bg-white border-0" name="transportation" id="currency">
                                        <option value="Motorbike (Personal)">Motorbike (Personal)</option>
                                        <option value="Car (Personal)">Car (Personal)</option>
                                        <option value="Bicycle (Personal)">Bicycle (Personal)</option>
                                        <option value="Motorbike (Rental)">Motorbike (Rental)</option>
                                        <option value="Car (Rental)">Car (Rental)</option>
                                        <option value="Bicycle (Rental)">Bicycle (Rental)</option>
                                        <option value="Public transport">Public transport</option>
                                        <option value="Unknown">Unknown</option>
                                    </select>
                                    <label for="end_date">transportation</label>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-floating">
                                    <input type="number" class="form-control border-0" id="budget" name="budget" placeholder="">
                                    <label for="budget">Budget</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <select class="form-control bg-white border-0" name="currency" id="currency">
                                        @foreach($currencies as $currency)
                                            <option value="{{$currency->code }}">{{$currency->country}} - {{$currency->code }}</option>
                                        @endforeach
                                    </select>
                                    <label for="currency">Currency</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-floating">
                                            <input type="number" class="form-control border-0" name="adults" id="adults" placeholder="">
                                            <label for="adults">Adults</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-floating">
                                            <input type="number" class="form-control border-0" name="children-2" id="children-2" placeholder="">
                                            <label for="children-2">Children</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-floating">
                                            <input type="number" class="form-control border-0" name="children-1" id="children-1" placeholder="">
                                            <label for="children-1">Baby</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select data-placeholder="Interest" class="chosen-select form-control" name="interest[]" multiple >
                                        @foreach($preferences as $preference)
                                            <option value="{{$preference->name}}"> {{$preference->name}} </option>
                                        @endforeach
                                    </select>
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
                <div class="mt-5 row bg-white rounded schedule-page" style="height: 70rem">

                    <h2 class="text-center mt-4 mb-3">{{ $weather['location']['name'] }}, {{ $weather['location']['country'] }}</h2>
                    <hr>
                    <div class="col-lg-7 ps-4 h-90">
                        <div class="weather h-15">
                            @if(isset($error))
                                <p style="color: red;">{{ $error }}</p>
                            @else

                                @if(isset($weather['forecast']) && isset($weather['forecast']['forecastday']))
                                    <ul class="row mb-0 pb-4">
                                        @foreach($weather['forecast']['forecastday'] as $day)
                                            <li class="col-4">
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
                        <div class="h-85 border-top">
                            <!-- Carousel Start -->
                            <div class="carousel-header h-95">
                                <div id="carouselId" class="carousel slide h-100 mb-0 mt-2 ps-0" data-bs-ride="carousel" data-bs-interval="false">
                                    <ol class="carousel-indicators menu-schedule mb-1">
                                        <li data-bs-target="#carouselId" data-bs-slide-to="0" class="border-0 m-0 p-0 active col-4 col-sm-3">List of locations</li>
                                        <li data-bs-target="#carouselId" data-bs-slide-to="1" class="border-0 m-0 p-0 col-4 col-sm-3 Schedule-tab">Schedule</li>
                                        <li data-bs-target="#carouselId" data-bs-slide-to="2" class="border-0 m-0 p-0  col-4 col-sm-3 Event-tab">Event/Activity</li>
                                        <li data-bs-target="#carouselId" data-bs-slide-to="3" class="border-0 button-show-map m-0 p-0  col-lg-4 col-sm-3 Event-tab">Map</li>
                                    </ol>
                                    <div class="carousel-inner border-top h-95 mb-2" role="listbox">
                                        <div class="carousel-item active h-100 list-of-locations mt-2">
                                            @if(isset($places))
                                                @foreach($places as $place => $thong_tin)
                                                    @php
        $placeName = $thong_tin['Tên'] ?? ($thong_tin['Tên địa điểm'] ?? null);
                                                    @endphp
                                                                                                        <div class="w-100 h-30 border me-1 mb-2">
                                                                                                            <div class="row h-100 w-100 ms-1">
                                                                                                                <div class="h-100 col-11 p-0 d-flex" >
                                                                                                                    <div class="w-35 align-content-center position-relative h-100 p-0">
                                                                                                                        <img class="w-85 h-90 ms-2 rounded mt-0 " src="

                                                                                                                            @if(isset($placecontent[$placeName]['thumbnail']))
                                                                                                                                {{ $placecontent[$placeName]['thumbnail'] }}
                                                                                                                            @else
                                                                                                                                {{ asset('frontend/images/image-coming-soon.jpg') }}
                                                                                                                            @endif


                                                                                                                        ">
                                                    {{--                                                                    <img class="w-65 h-80 ms-2 rounded position-absolute sec-image" src="{{asset('frontend/images/destination-3.jpg')}}">--}}
                                                                                                                    </div>
                                                                                                                    <div class="w-65 h-60 m-auto p-0">
                                                                                                                        @foreach ($thong_tin as $key => $value)
                                                                                                                            @if($key == "Tên" || $key == "Tên địa điểm" || $key == 0)
                                                                                                                                <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" data-place="{{ $value }}"><p class="fw-bold" >{{$value}}</p></a>
                                                                                                                            @elseif($key != "lat" && $key != "lon")
                                                                                                                                @if(is_array($value))
                                                                                                                                    <div id="scroll-tag" class="overflow-x-scroll d-flex w-95">
                                                                                                                                            @foreach($value as $tag)
                                                                                                                                                <a class="me-2" href="" style="flex-shrink: 0;"><span class="btn mb-1">{{ $tag }}</span></a>
                                                                                                                                            @endforeach
                                                                                                                                    </div>
                                                                                                                                @else
                                                                                                                                <p>
                                                                                                                                    {{$key}} : {{$value}}
                                                                                                                                </p>
                                                                                                                                @endif
                                                                                                                            @endif
                                                                                                                        @endforeach
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <a href="#" class="col-1 p-0">
                                                                                                                    <div class=" h-100 p-0 border-start align-content-center white" >
                                                                                                                        <div class="h-33 d-flex align-items-center justify-content-center comment border-bottom"><i class="fa-solid fa-comment"></i></div>
                                                                                                                        <div class="h-33 d-flex align-items-center justify-content-center delete border-bottom"><i class="fa-solid fa-trash"></i></div>
                                                                                                                        <div class="h-33 d-flex align-items-center justify-content-center redirect" data-lat="{{$thong_tin['lat'] ?? ''}}" data-lon="{{$thong_tin['lon'] ?? ''}}"><i class="fa-solid fa-diamond-turn-right"></i></div>
                                                                                                                    </div>
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div id="schedule-response" class="carousel-item h-100 schedule">
                                            <div id="btn-build-schedule" class="container-fluid h-50 mt-2">
                                                <div id="schedule-response" class="container h-100 text-center">
                                                    <button id="generateSchedule" class="rounded btn btn-primary p-3 m-t-100" data-place-names="{{ json_encode($for_schedule) }}">
                                                        <span class="d-none" id="get-url-schedule" data-url="{{route('build-schedule')}}"></span>
                                                        <span class="d-block"><i class="bi bi-stars"></i> Generate Detailed Itinerary <i class="bi bi-stars"></i></span>
                                                        <span class="d-block fw-normal">- Based on a list of locations -</span>
                                                    </button>

                                                </div>
                                            </div>
                                            <!-- Spinner Start -->
                                            <div class="position-relative h-50">
                                                <div id="spinner2" class="show bg-white position-absolute translate-middle w-100 top-50 start-50 align-items-center justify-content-center d-none">
                                                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Spinner End -->
                                        </div>
                                        <div id="event-response" class="carousel-item h-100 eventAndActivity mt-2">
                                            <div id="btn-get-event" class="container-fluid h-50 mt-2">
                                                <div id="schedule-response" class="container text-center">
                                                    <button id="getEvent" class="rounded btn btn-primary p-3 m-t-100" data-address="{{ json_encode($for_event) }}">
                                                        <span class="d-none" id="get-url-event" data-url="{{route('get-event')}}"></span>
                                                        <span class="d-block"><i class="bi bi-stars"></i>&nbsp; Check out current events and activities &nbsp;<i class="bi bi-stars"></i></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- Spinner Start -->
                                            <div class="position-relative h-50">
                                                <div id="spinner3" class="show bg-white position-absolute translate-middle w-100 top-50 start-50 align-items-center justify-content-center d-none">
                                                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Spinner End -->

                                        </div>
                                        <div id="map-response" class="carousel-item h-100 eventAndActivity mt-2">

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Carousel End -->
                        </div>
                    </div>
                    <div class="col-lg-5 p-0">
                        <div id="result-map">
                            @if(isset($error))
                                <div  class="alert alert-danger">{{ $error }}</div>
                            @elseif(isset($map))
                                <div class="card border-start-0 border-0">
                                    <div class="card-body pt-0">
                                        <div id="map" style="width: 100%; height: 61rem;">

                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
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


    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Explore the Place</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    <!-- Image Carousel -->
                    <div class="col-md-6">
                        <div id="carouselExample" class="carousel slide">
                            <div id="carousel-inner" class="carousel-inner rounded overflow-hidden shadow-sm">
                                <!-- Images will be injected dynamically here -->
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <!-- Info Section -->
                    <div class="col-md-6 overflow-auto" style="max-height: 60vh;">
                        <div class="mb-3">
                            <h4 class="mb-0" id="modal-title">Tên địa điểm</h4>
                            <span id="modal-category" class="badge bg-secondary fs-6">Loại địa điểm</span>
                        </div>

                        <div class="mb-4">
                            <h5>📌 Thông tin chi tiết:</h5>
                            <div id="modal-info" class="list-group small"></div>
                        </div>

                        <div class="mb-3">
                            <h5 class="d-flex align-items-center">⭐ Đánh giá: 
                                <span id="modal-rating" class="ms-2 badge bg-warning text-dark fs-6">4.5</span>
                            </h5>
                            <div id="modal-review" class="list-group small mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #carousel-inner img {
        max-height: 350px;
        object-fit: cover;
    }
    #modal-info .list-group-item,
    #modal-review .list-group-item {
        background: #f8f9fa;
        border: none;
        padding: 0.5rem 0.75rem;
    }
</style>



    <!-- Modal Dialog End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    @if(isset($map))
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
            const initialLat = {{ $lat }};
            const initialLon = {{ $lon }};
            const initialZoom = 10;
            let map = null;
            let directionsRenderer = null;
            let rawProvinceName = "{{ $address_old }}";
            let provinceNameToDraw = rawProvinceName.replace(/^(Tỉnh|Thành phố|TP\.?|Tp\.?|tp\.?|thành phố|tỉnh)\s+/i, "").trim();
            console.log(provinceNameToDraw)
            function initMap() {
                console.log("Map4D SDK đã tải xong. Bắt đầu khởi tạo bản đồ.");
                map = new map4d.Map(document.getElementById("map"), {
                    center: { lat: initialLat, lng: initialLon },
                    zoom: initialZoom,
                    controls: true,
                    mapType: "satellite"
                });
                let marker = new map4d.Marker({
                    position: {lat: initialLat, lng:initialLon},
                })
                marker.setMap(map)
                directionsRenderer = new map4d.DirectionsRenderer({ map: map });
                if (provinceNameToDraw) {
                    drawProvinceByName(provinceNameToDraw);
                } else {
                    console.warn("Không có tên tỉnh được chỉ định để vẽ.");
                }

                const routeButton = document.getElementById('routeButton');
                if (routeButton) {
                    routeButton.addEventListener('click', function() {
                        console.log("Button 'Chỉ đường' clicked.");
                        const pointA = { lat: 21.0333, lng: 105.8500 }; // Gần Hồ Tây
                        const pointB = { lat: 21.0379, lng: 105.8346 }; // Lăng Bác
                        const travelMode = 'car';
                        requestAndDisplayRoute(pointA, pointB, travelMode);
                    });
                } else {
                    console.error("HTML element with ID 'routeButton' not found.");
                }
            }
            async function drawProvinceByName(provinceName) {
                const geojsonUrl = '/vn.json';
                try {
                    const response = await axios.get(geojsonUrl);
                    const geojsonData = response.data;
                    if (!geojsonData || geojsonData.type !== 'FeatureCollection' || !Array.isArray(geojsonData.features)) {
                        return;
                    }
                    const foundProvinceFeature = geojsonData.features.find(feature =>
                        feature.properties && feature.properties.ten_tinh === provinceName
                    );
                    if (foundProvinceFeature) {
                        const boundaryStyleOptions = {

                        };
                        const drawFeatureGeometry = (geometry, styleOptions) => {
                            const drawn = [];
                            if (!geometry || !geometry.coordinates) return drawn;
                            const processLinearRingAndDraw = (linearRingCoords) => {
                                if (Array.isArray(linearRingCoords) && linearRingCoords.length >= 3) {
                                    const path = linearRingCoords.map(coord => {
                                        if (Array.isArray(coord) && coord.length >= 2 && typeof coord[0] === 'number' && typeof coord[1] === 'number') {
                                            return { lat: coord[1], lng: coord[0] };
                                        }
                                        return null;
                                    }).filter(point => point !== null);


                                    if (path.length >= 3) {
                                        let polygon = new map4d.Polygon({
                                            fillOpacity: 0.1,
                                            strokeWidth: 1.5,
                                            userInteractionEnabled: true,
                                            paths: [path],
                                        });
                                        polygon.setMap(map)
                                        drawn.push(polygon);
                                    } else {
                                        console.warn("Bỏ qua LinearRing không đủ điểm hợp lệ (>=3) sau chuyển đổi/lọc. Path:", path);
                                    }
                                } else {
                                    console.warn(`Bỏ qua LinearRing không đủ điểm ban đầu (>=3). Số điểm: ${linearRingCoords ? linearRingCoords.length : 'null'}.`, linearRingCoords);
                                }
                            };
                            if (geometry.type === 'Polygon') {
                                if(Array.isArray(geometry.coordinates)) {
                                    geometry.coordinates.forEach(linearRingCoords => {
                                        processLinearRingAndDraw(linearRingCoords);
                                    });
                                } else {
                                    console.warn("Cấu trúc Polygon.coordinates không phải mảng.");
                                }
                            } else if (geometry.type === 'MultiPolygon') {
                                if(Array.isArray(geometry.coordinates)) {
                                    geometry.coordinates.forEach(polygonCoords => {
                                        if(Array.isArray(polygonCoords)) {
                                            polygonCoords.forEach(linearRingCoords => {
                                                processLinearRingAndDraw(linearRingCoords);
                                            });
                                        } else {
                                            console.warn("Cấu trúc MultiPolygon lồng không phải mảng (polygonCoords).");
                                        }
                                    });
                                } else {
                                    console.warn("Cấu trúc MultiPolygon.coordinates không phải mảng.");
                                }
                            }
                            return drawn;
                        };



                        const drawnPolygons = drawFeatureGeometry(foundProvinceFeature.geometry, boundaryStyleOptions);
                        let minLat = Infinity;
                        let maxLat = -Infinity;
                        let minLng = Infinity;
                        let maxLng = -Infinity;
                        const collectAndCalculateBounds = (coordsArray) => {
                            if (!Array.isArray(coordsArray)) return;
                            if (Array.isArray(coordsArray[0]) && typeof coordsArray[0][0] === 'number') {
                                coordsArray.forEach(coord => {
                                    if (Array.isArray(coord) && coord.length >= 2 && typeof coord[0] === 'number' && typeof coord[1] === 'number') {
                                        minLat = Math.min(minLat, coord[1]); // coord[1] là lat
                                        maxLat = Math.max(maxLat, coord[1]); // coord[1] là lat
                                        minLng = Math.min(minLng, coord[0]); // coord[0] là lng
                                        maxLng = Math.max(maxLng, coord[0]); // coord[0] là lng
                                    }
                                });
                            } else {
                                coordsArray.forEach(subArray => collectAndCalculateBounds(subArray));
                            }
                        };
                        try {
                            fitMapToBoundsFromCoordinates(map, foundProvinceFeature.geometry.coordinates);
                        } catch (e) {
                            map.setCenter({ lat: initialLat, lng: initialLon });
                            map.setZoom(initialZoom);
                        }


                    } else {
                        map.setCenter({lat: initialLat, lng: initialLon});
                        map.setZoom(initialZoom);
                    }


                } catch (error) {
                    console.error("Lỗi khi tải hoặc xử lý GeoJSON:", error);
                    alert("Không thể tải hoặc xử lý dữ liệu ranh giới từ server.");
                }
            }

            async function requestAndDisplayRoute(origin, destination, travelMode) {
                if (!directionsRenderer) {
                    console.error("DirectionsRenderer chưa được khởi tạo.");
                    return;
                }

                // Lấy API Key từ script tag
                const map4dScript = document.querySelector('script[src*="api.map4d.vn/sdk/map/js"]');
                let apiKey = '';
                if (map4dScript) {
                    const src = map4dScript.getAttribute('src');
                    const urlParams = new URLSearchParams(src.split('?')[1]);
                    apiKey = urlParams.get('key');
                    console.log("Map4D API Key detected from script tag:", apiKey);
                } else {
                    console.error("Map4D SDK script tag not found to extract API key. Please provide API Key manually.");
                    alert("Không thể lấy API Key Map4D từ script tag.");
                    return;
                }
                const routeApiUrl = `https://api.map4d.vn/sdk/route?origin=${origin.lat},${origin.lng}&destination=${destination.lat},${destination.lng}&mode=${travelMode}&key=${apiKey}`;
                try {
                    const response = await axios.get(routeApiUrl);
                    if (response.data && response.data.code === 'ok' && response.data.result.routes && response.data.result.routes.length > 0) {
                        if (directionsRenderer) {
                            directionsRenderer.setMap(null);  // Xóa bản đồ hiện tại
                        }
                        let directions = new map4d.DirectionsRenderer({
                            routes: response.data,
                            originMarkerOptions: {
                                position: {lat: origin.lat, lng: origin.lng },
                                title: "Start",
                                draggable: false,
                                strokePattern: new map4d.IconPattern({
                                    url: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAICAYAAADwdn+XAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAIdJREFUeNpiZMAC7L0XGACpeiAOgAptAOLGg1sTLqCrZcShef8HXXmBT2pSYDG+W88YBC4//ABkOqIbwoTFAfUgzR905Bj+sbGAMYgNEoO6ioGQAQEwm5EBVCyAGANIAtgM2ADyMzqAim0gxoBGUIAJXHnEwPTrDxiD2NBAbCQYC6RGI0CAAQDXEjYOjbjUPQAAAABJRU5ErkJggg=="
                                }),
                                visible: true
                            },
                            destinationMarkerOptions: {
                                position: {lat: destination.lat, lng: destination.lng},
                                title: "End",
                                visible: true,
                                draggable: false,
                                strokePattern: new map4d.IconPattern({
                                    url: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAICAYAAADwdn+XAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAIdJREFUeNpiZMAC7L0XGACpeiAOgAptAOLGg1sTLqCrZcShef8HXXmBT2pSYDG+W88YBC4//ABkOqIbwoTFAfUgzR905Bj+sbGAMYgNEoO6ioGQAQEwm5EBVCyAGANIAtgM2ADyMzqAim0gxoBGUIAJXHnEwPTrDxiD2NBAbCQYC6RGI0CAAQDXEjYOjbjUPQAAAABJRU5ErkJggg=="
                                }),
                                userInteractionEnabled: true
                            },
                            strokePattern: new map4d.IconPattern({
                                url: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAICAYAAADwdn+XAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAIdJREFUeNpiZMAC7L0XGACpeiAOgAptAOLGg1sTLqCrZcShef8HXXmBT2pSYDG+W88YBC4//ABkOqIbwoTFAfUgzR905Bj+sbGAMYgNEoO6ioGQAQEwm5EBVCyAGANIAtgM2ADyMzqAim0gxoBGUIAJXHnEwPTrDxiD2NBAbCQYC6RGI0CAAQDXEjYOjbjUPQAAAABJRU5ErkJggg=="
                            }),
                            activeOutlineWidth: 3,
                            inactiveOutlineWidth: 3,
                            inactiveOutlineColor: "#FF00FF",
                        })
                        directions.setMap(map)


                    } else {
                        console.warn("Không có tuyến đường nào hoặc có lỗi trong dữ liệu trả về. Dữ liệu trả về:", response.data);
                        alert("Không tìm thấy tuyến đường cho các điểm đã chọn.");
                    }

                } catch (error) {
                    console.error("❌ Lỗi khi gọi API Map4D:", error);
                    alert("Có lỗi xảy ra khi yêu cầu tính toán tuyến đường.");
                }
            }

            function fitMapToBoundsFromCoordinates(map, coordinates) {
                let minLat = Infinity;
                let maxLat = -Infinity;
                let minLng = Infinity;
                let maxLng = -Infinity;

                const traverseCoords = (coordsArray) => {
                    if (!Array.isArray(coordsArray)) return;
                    if (Array.isArray(coordsArray[0]) && typeof coordsArray[0][0] === 'number') {
                        coordsArray.forEach(coord => {
                            if (Array.isArray(coord) && coord.length >= 2) {
                                minLat = Math.min(minLat, coord[1]);
                                maxLat = Math.max(maxLat, coord[1]);
                                minLng = Math.min(minLng, coord[0]);
                                maxLng = Math.max(maxLng, coord[0]);
                            }
                        });
                    } else {
                        coordsArray.forEach(subArray => traverseCoords(subArray));
                    }
                };

                traverseCoords(coordinates);

                if (minLat !== Infinity && minLng !== Infinity) {
                    const bounds = [
                        { lat: minLat, lng: minLng },
                        { lat: maxLat, lng: maxLng }
                    ];
                    try {
                        map.fitBounds(bounds);
                    } catch (e) {
                        console.error("Không thể fitBounds:", e);
                    }
                }
            }

            let clickedMarker = null; // Biến để lưu marker hiện tại

            $(document).ready(function() {
                console.log('aaaaaaa'); // Đảm bảo dòng này nằm trong đây

                let clickedMarker = null;

                $('.redirect').click(function () {
                    const lat = parseFloat($(this).data('lat'));
                    const lon = parseFloat($(this).data('lon'));

                    console.log(lat)
                    console.log(lon)
                    if (!isNaN(lat) && !isNaN(lon)) {
                        // Xóa marker cũ
                        if (clickedMarker) {
                            clickedMarker.setMap(null);
                        }

                        // Tạo marker mới
                        clickedMarker = new map4d.Marker({
                            position: { lat: lat, lng: lon },
                            title: "Vị trí",
                            label: { text: "!", color: "white" }
                        });
                        clickedMarker.setMap(map);

                        // Di chuyển bản đồ đến vị trí
                        map.setCenter({ lat: lat, lng: lon });
                    } else {
                        console.warn("Toạ độ không hợp lệ.");
                    }
                });
            });

        </script>
        <script src="https://api.map4d.vn/sdk/map/js?version=2.6&key=320fdc09342c67c6879c20e64e1475c0&mapId=680393095d65bdb7b81fdcaf&callback=initMap"></script>

    @endif

@endsection


@push('extra_scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('exampleModal');
    modal.addEventListener('show.bs.modal', function (event) {
        // Get clicked place name from data attribute
        var trigger = event.relatedTarget;
        var placeName = trigger.getAttribute('data-place');
        @if (isset($placecontent) )
        var placecontent = {!! json_encode($placecontent) !!};
        @endif

        
        var content = placecontent[placeName] || {};
        console.log('content', content);
        // Update modal title
     
        document.getElementById('modal-title').textContent = content.title || placeName;

        // Update modal content
        const carouselInner = document.getElementById('carousel-inner');
        carouselInner.innerHTML = ''; // Clear previous items

        if (Array.isArray(content.images) && content.images.length > 0) {
            content.images.forEach((imgUrl, index) => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'carousel-item' + (index === 0 ? ' active' : '');

                const img = document.createElement('img');
                img.src = imgUrl;
                img.className = 'd-block w-100 img-fluid';
                img.alt = `Image ${index + 1}`;

                itemDiv.appendChild(img);
                carouselInner.appendChild(itemDiv);
            });
        } else {
            // fallback placeholder
            const itemDiv = document.createElement('div');
            itemDiv.className = 'carousel-item active';

            const img = document.createElement('img');
            img.src = '{{ asset("frontend/images/image-coming-soon.jpg") }}';
            img.className = 'd-block w-100 img-fluid';
            img.alt = 'Placeholder';

            itemDiv.appendChild(img);
            carouselInner.appendChild(itemDiv);
        }

        $info = "<ul class= 'list-group list-group-flush'>";
        if (Array.isArray(content.info) && content.info.length > 0) {
            content.info.forEach((info, index) => {
                $info += `<li class='list-group-item'>${info}</li>`;
            });
        }
        $info += "</ul>";
        document.getElementById('modal-info').innerHTML = $info;
        // Update text content
       

        $review = "<ul class= 'list-group list-group-flush'>";
        if (Array.isArray(content.reviews) && content.reviews.length > 0) {
            content.reviews.forEach((review, index) => {
                $review += `<li class='list-group-item'>${review}</li>`;
            });
        }
        $review += "</ul>";


        document.getElementById('modal-review').innerHTML = $review;

        document.getElementById('modal-category').textContent = content.category || '';
        
        document.getElementById('modal-rating').innerHTML = content.rating 
    ? `${content.rating} <i class="bi bi-star-fill"></i>` 
    : '';
    });
});
</script>
@endpush

@push('extra_scripts')
    <script>
        console.log("Hello from view con!");
        $(document).on('click' , '.requestAndDisplayRoute', function() {

        })
    </script>
@endpush
