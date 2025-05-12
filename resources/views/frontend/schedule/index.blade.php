@extends('frontend.layouts.layout')
@section('content')
    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        @include('frontend.component.navbar')
    </div>
    <!-- Navbar & Hero End -->

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb" style="background: linear-gradient(rgba(19, 53, 123, 0.5), rgba(19, 53, 123, 0.5)), url({{ asset('frontend/images/breadcrumb-bg.jpg') }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
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
                <div class="col-lg-8">
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
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="date" class="form-control border-0" id="start_date" name="start_date" placeholder="">
                                    <label for="start_date">Departure date</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="date" class="form-control border-0" id="end_date" name="end_date" placeholder="">
                                    <label for="end_date">Return date</label>
                                </div>
                            </div>
                            <div class="col-md-4">
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
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <input type="number" class="form-control border-0" id="budget" name="budget" placeholder="">
                                    <label for="budget">Budget</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select class="form-control bg-white border-0" name="currency" id="currency">
                                        @foreach($currencies as $currency)
                                            <option value="{{$currency->code }}">{{$currency->country}} - {{$currency->code }}</option>
                                        @endforeach
                                    </select>
                                    <label for="currency">Currency</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="number" class="form-control border-0" name="adults" id="adults" placeholder="">
                                            <label for="adults">Adults > 10 years old</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="number" class="form-control border-0" name="children-2" id="children-2" placeholder="">
                                            <label for="children-2">Children 2 - 10 years old</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="number" class="form-control border-0" name="children-1" id="children-1" placeholder="">
                                            <label for="children-1">Children < 2 years old </label>
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
                                        <li class="col-12 col-lg-4">
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
                            <div id="carouselId" class="carousel slide h-100 mb-0 mt-2 ps-0" data-bs-ride="carousel" data-bs-interval="false"  data-bs-touch="false">
                                <ol class="carousel-indicators menu-schedule mb-1">
                                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="border-0 m-0 p-0 active col-lg-4">List of locations</li>
                                    <li data-bs-target="#carouselId" data-bs-slide-to="1" class="border-0 m-0 p-0 col-lg-4 Schedule-tab">Schedule</li>
                                    <li data-bs-target="#carouselId" data-bs-slide-to="2" class="border-0 m-0 p-0  col-lg-4 Event-tab">Event/Activity</li>
                                    <li data-bs-target="#carouselId" data-bs-slide-to="3" class="border-0 m-0 p-0 col-lg-4 Map-tab d-lg-none">Bản đồ</li>
    
                                </ol>
                                <div class="carousel-inner border-top h-95 mb-2" role="listbox">
                                    <div class="carousel-item active h-100 list-of-locations mt-2">
                                        @if(isset($places))
                                            @foreach($places as $place => $thong_tin)
                                                <div class="w-100 h-30 border me-1 mb-2">
                                                    <div class="row h-100 w-100 ms-1">
                                                        <a href="#" class="h-100 col-lg-11 p-0 d-flex">
                                                            <div class="w-35 align-content-center position-relative h-100 p-0">
                                                                <img class="w-75 h-90 ms-2 rounded  " src="{{asset('frontend/images/destination-3.jpg')}}">
                                                                <img class="w-65 h-80 ms-2 rounded position-absolute sec-image" src="{{asset('frontend/images/destination-3.jpg')}}">
                                                            </div>
                                                            <div class="w-65 h-60 m-auto p-0">
                                                                @foreach ($thong_tin as $key => $value)
                                                                    @if($key == "Tên" || $key == "Tên địa điểm" || $key == 0)
                                                                            <p class="fw-bold">{{$value}}</p>
                                                                    @else
                                                                        <p class="">
                                                                            @if(is_array($value))
                                                                                @foreach($value as $tag)
                                                                                    <span class="btn">{{ $tag }}</span>
                                                                                @endforeach
                                                                            @else
                                                                                {{$key}} : {{$value}}
                                                                            @endif
                                                                        </p>
                                                                    @endif
                                                                @endforeach                                                              
                                                            </div>
                                                            </a>
                                                        <a href="#" class="col-lg-1 p-0"><div class=" h-100 p-0 delete align-content-center white"><i class="bi bi-trash"></i></div></a> 
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
                                            <div id="schedule-response" class="container h-100 text-center">
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
                                    <div class="carousel-item h-100 map-slide mt-2 d-lg-none">
                                        @if(isset($map))
                                            <div class="card border-start-0 border-0">
                                                <div class="card-body pt-0">
                                                    <div id="mapmobile" style="width: 100%; height: 70rem;">
                                                        <div class="menu">
                                                            <button id="routeButtonMobile">Chỉ đường từ A đến B</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>  
                                     
                            </div>
                            
                        </div>
                              
                        <!-- Carousel End -->
                    </div>
                </div>
                <div class="col-lg-5 p-0 d-none d-lg-block ">
                    @if(isset($error))
                        <div class="alert alert-danger">{{ $error }}</div>
                    @elseif(isset($map))
        
                        <div class="card border-start-0 border-0">
                            <div class="card-body pt-0">
                                <div id="map" style="width: 100%; height: 61rem;">
                                    <div class="menu">
                                        <button id="routeButton">Chỉ đường từ A đến B</button>
                                    </div>
                                </div>
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

    @if(isset($map))



        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>



        <script>
            const initialLat = {{ $lat }};
            const initialLon = {{ $lon }};
            const initialZoom = 10;
            let map = null;
            let directionsRenderer = null;
            let mapMobile = null;
            let directionsRendererMobile = null;
            let rawProvinceName = "{{ $address_old }}";
            let provinceNameToDraw = rawProvinceName.replace(/^(Tỉnh|Thành phố|TP\.?|Tp\.?|tp\.?|thành phố|tỉnh)\s+/i, "").trim();
            console.log(provinceNameToDraw)

function initMap() {
    console.log("Map4D SDK đã tải xong. Bắt đầu khởi tạo bản đồ.");

    // === Desktop Map ===
    map = new map4d.Map(document.getElementById("map"), {
        center: { lat: initialLat, lng: initialLon },
        zoom: initialZoom,
        controls: true,
        mapType: "satellite"
    });

    let marker = new map4d.Marker({
        position: { lat: initialLat, lng: initialLon },
    });
    marker.setMap(map);

    directionsRenderer = new map4d.DirectionsRenderer({ map: map });

    if (provinceNameToDraw) {
        drawProvinceByName(provinceNameToDraw, map);
    }

    // === Mobile Map ===
    const mapMobileElement = document.getElementById("mapmobile");
    if (mapMobileElement) {
        
        console.log("Khởi tạo bản đồ mobile...");
        mapMobile = new map4d.Map(mapMobileElement, {
            center: { lat: initialLat, lng: initialLon },
            zoom: initialZoom,
            controls: true,
            mapType: "satellite"
        });

        const markerMobile = new map4d.Marker({
            position: { lat: initialLat, lng: initialLon }
        });
        markerMobile.setMap(mapMobile);

        directionsRendererMobile = new map4d.DirectionsRenderer({ map: mapMobile });

        if (provinceNameToDraw) {
            drawProvinceByName(provinceNameToDraw, mapMobile);
        }
    }

     // === Nút chỉ đường cho desktop ===
    const routeButton = document.getElementById('routeButton');
    if (routeButton && map && directionsRenderer) {
        routeButton.addEventListener('click', function () {
            console.log("Desktop: Button 'Chỉ đường' clicked.");
            const pointA = { lat: 21.0333, lng: 105.8500 };
            const pointB = { lat: 21.0379, lng: 105.8346 };
            const travelMode = 'car';

            requestAndDisplayRoute(pointA, pointB, travelMode, map);
        });
    }

    // === Nút chỉ đường cho mobile ===
    const routeButtonMobile = document.getElementById('routeButtonMobile');
    if (routeButtonMobile && mapMobile && directionsRendererMobile) {
        routeButtonMobile.addEventListener('click', function () {
            console.log("Mobile: Button 'Chỉ đường' clicked.");
            const pointA = { lat: 21.0333, lng: 105.8500 };
            const pointB = { lat: 21.0379, lng: 105.8346 };
            const travelMode = 'car';

            requestAndDisplayRoute(pointA, pointB, travelMode, mapMobile);
        });
    }
}


            async function drawProvinceByName(provinceName, mapInstance) {
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
                                        polygon.setMap(mapInstance)
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

            async function requestAndDisplayRoute(origin, destination, travelMode,mapInstance) {
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
                        directions.setMap(mapInstance)

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



        </script>
        <script src="https://api.map4d.vn/sdk/map/js?version=2.6&key=320fdc09342c67c6879c20e64e1475c0&mapId=680393095d65bdb7b81fdcaf&callback=initMap"></script>

    @endif

@endsection

@push('styles')
<style>

.hamburger-menu {
  display: none;
}




/* 🔵 Mobile (<480px) */
@media (max-width: 480px) {
  .navbar-nav, .nav-links, .top-links {
    display: none;
  }

  .hamburger-menu {
    display: block;
  }

  .navbar {
    justify-content: space-between;
    padding: 0 1rem;
  }

  .navbar-brand {
    font-size: 1.5rem;
  }
  .bg-breadcrumb {
      height: 40vh !important; 
    align-items: center;
    justify-content: center;
    text-align: center;
  }

    .bg-breadcrumb .container {
    padding: 0 !important;
  }

  .bg-breadcrumb h1 {
    font-size: 1.4rem !important;
    margin-bottom: 0.5rem !important;
  }

  .breadcrumb {
    font-size: 0.75rem;
    justify-content: center;
  }

  .image-left-schedule {
    display: none !important;
    visibility: hidden !important;
    pointer-events: none !important;
  }

 .image-left-schedule *,
  .image-left-schedule img {
    display: none !important;
    visibility: hidden !important;
    pointer-events: none !important;
    position: static !important;
    width: 0 !important;
    height: 0 !important;
    overflow: hidden !important;
  }
  /* Form container full width */
  .col-lg-8 {
    width: 100% !important;
    flex: 0 0 100% !important;
    max-width: 100% !important;
  }

  /* Gộp tất cả các input theo 1 cột */
  .col-md-4,
  .col-md-8,
  .col-md-12 {
    width: 100% !important;
    flex: 0 0 100% !important;
    max-width: 100% !important;
  }

  input[name="adults"],
  input[name="children-2"],
  input[name="children-1"] {
    margin-bottom: 0.7rem !important;
  }

  .form-floating > input,
  .form-floating > select,
  .form-floating > textarea {
    height: auto !important;
    padding: 1.8rem 1rem 0.5rem !important;
  }

  .form-floating > label {
    font-size: 1.1rem !important;
      padding: 1rem 1.5rem !important;
    pointer-events: none;
  }
  /* Giảm cỡ nút */
  .btn.w-100 {
    padding: 0.75rem !important;
    font-size: 1rem;
  }

  /* Tiêu đề và spacing */
  h3.mb-2 {
    font-size: 1.2rem !important;
    text-align: center;
  }
  .subscribe,
  .footer,
  .copyright {
    display: none !important;
  }
  .schedule-page {
    height: auto !important;
  }



/* ✅ Khối chứa ảnh (w-35) */
.carousel-item .w-35 {
  width: 30% !important;                /* Chiếm 30% chiều ngang container */
  display: flex;                        /* Dùng flex để dễ căn giữa */
  align-items: center;                  /* Căn giữa theo chiều dọc */
  justify-content: flex-start;             /* Căn giữa theo chiều ngang */
  padding-left: 0.25rem;                /* Đẩy ảnh cách mép trái một chút */
}

/* ✅ Ảnh hiển thị chính */
.carousel-item img {
   margin-top: 0 !important;
}

/* ✅ Ảnh đè (nếu có dùng ảnh overlay hoặc ảnh phụ) sẽ bị ẩn trên mobile */
.carousel-item .sec-image {
  display: none !important;            /* Ẩn hoàn toàn ảnh thứ hai */
}


  .carousel-item .w-65 {
    width: 65% !important;
    padding: 0 !important;
  }

 

  .carousel-item .w-65 p,
  .carousel-item .w-65 span {
    font-size: 0.85rem;
    line-height: 1.3;
  }

  .carousel-item .btn {
    font-size: 0.6rem !important;
    padding: 0.3rem 0.5rem !important;
  }

 .carousel-item .row {
    position: relative;
  }

  .carousel-item .delete {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    z-index: 10;
    background: white;
    padding: 0.25rem;
    border-radius: 4px;
  }

.routeButton {
    display: none;
}

}


</style>
@endpush


@push('styles')
<style>




/* 🔵 tablet (<768px) */
@media (max-width: 768px) {
  .navbar-nav, .nav-links, .top-links {
    display: none;
  }

  .hamburger-menu {
    display: block;
  }

  .navbar {
    justify-content: space-between;
    padding: 0 1rem;
  }

  .navbar-brand {
    font-size: 1.5rem;
  }
  .bg-breadcrumb {
      height: 40vh !important; 
    align-items: center;
    justify-content: center;
    text-align: center;
  }

    .bg-breadcrumb .container {
    padding: 0 !important;
  }

  .bg-breadcrumb h1 {
    font-size: 1.4rem !important;
    margin-bottom: 0.5rem !important;
  }

  .breadcrumb {
    font-size: 0.75rem;
    justify-content: center;
  }

  .image-left-schedule {
    display: none !important;
    visibility: hidden !important;
    pointer-events: none !important;
  }

 .image-left-schedule *,
  .image-left-schedule img {
    display: none !important;
    visibility: hidden !important;
    pointer-events: none !important;
    position: static !important;
    width: 0 !important;
    height: 0 !important;
    overflow: hidden !important;
  }
  /* Form container full width */
  .col-lg-8 {
    width: 100% !important;
    flex: 0 0 100% !important;
    max-width: 100% !important;
  }

  /* Gộp tất cả các input theo 1 cột */
  .col-md-4,
  .col-md-8,
  .col-md-12 {
    width: 100% !important;
    flex: 0 0 100% !important;
    max-width: 100% !important;
  }

  input[name="adults"],
  input[name="children-2"],
  input[name="children-1"] {
    margin-bottom: 0.7rem !important;
  }

  .form-floating > input,
  .form-floating > select,
  .form-floating > textarea {
    height: auto !important;
    padding: 1.8rem 1rem 0.5rem !important;
  }

  .form-floating > label {
    font-size: 1.1rem !important;
      padding: 1rem 1.5rem !important;
    pointer-events: none;
  }
  /* Giảm cỡ nút */
  .btn.w-100 {
    padding: 0.75rem !important;
    font-size: 1rem;
  }

  /* Tiêu đề và spacing */
  h3.mb-2 {
    font-size: 1.2rem !important;
    text-align: center;
  }
  .subscribe,
  .footer,
  .copyright {
    display: none !important;
  }
  .schedule-page {
    height: auto !important;
  }



/* ✅ Khối chứa ảnh (w-35) */
.carousel-item .w-35 {
  width: 30% !important;                /* Chiếm 30% chiều ngang container */
  display: flex;                        /* Dùng flex để dễ căn giữa */
  align-items: center;                  /* Căn giữa theo chiều dọc */
  justify-content: flex-start;             /* Căn giữa theo chiều ngang */
  padding-left: 0.25rem;                /* Đẩy ảnh cách mép trái một chút */
}

/* ✅ Ảnh hiển thị chính */
.carousel-item img {
   margin-top: 0 !important;
}

/* ✅ Ảnh đè (nếu có dùng ảnh overlay hoặc ảnh phụ) sẽ bị ẩn trên mobile */
.carousel-item .sec-image {
  display: none !important;            /* Ẩn hoàn toàn ảnh thứ hai */
}


  .carousel-item .w-65 {
    width: 65% !important;
    padding: 0 !important;
  }

 

  .carousel-item .w-65 p,
  .carousel-item .w-65 span {
    font-size: 0.85rem;
    line-height: 1.3;
  }

  .carousel-item .btn {
    font-size: 0.6rem !important;
    padding: 0.3rem 0.5rem !important;
  }

 .carousel-item .row {
    position: relative;
  }

  .carousel-item .delete {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    z-index: 10;
    background: white;
    padding: 0.25rem;
    border-radius: 4px;
  }

.routeButton {
    display: none;
}

}


</style>
@endpush





@push('extra_scripts')
    <script>
        console.log("Hello from view con!");
        $(document).on('click' , '.requestAndDisplayRoute', function() {

        })
    </script>
@endpush


