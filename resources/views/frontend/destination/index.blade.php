@extends('frontend.layouts.layout')
@section('content')


    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        @include('frontend.component.navbar')
    </div>
    <!-- Navbar & Hero End -->

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb" style="background: linear-gradient(rgba(19, 53, 123, 0.5), rgba(19, 53, 123, 0.5)), url({{ asset('frontend/images/breadcrumb-bg.jpg') }});">
        <div class="container-fluid text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4">Travel Destination</h3>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Destination</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Payment Start -->
    <div class="container-fluid destination py-5">
        <div class="container-fluid py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Destination</h5>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-lg-9 col-xl-9 col-xxl-7 mx-auto">
                    <span id="url_search" data-url="{{ route('destination.search') }}"> </span>
                    <form id="search-form" method="GET" class="search-form">
                        <div class="input-group shadow-lg rounded-pill overflow-hidden w-100 flex-nowrap" style="background: var(--bg-color); border: 1px solid var(--border-color); transition: all 0.3s ease;">
                            <input id="search-input" type="text" name="search" value="" class="form-control form-control-lg border-0 bg-transparent ps-4 py-3" placeholder="Search destination..." style="color: var(--text-primary); outline: none; box-shadow: none;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-class text-center col-lg-10 col-xl-10 col-xxl-8 mx-auto">
                <div class="w-100 d-flex justify-content-end align-items-center mb-4">
                    <div class="text-end">
                        <form method="get">
                            <span id="url_sort" data-url="{{ route('destination.sort') }}"> </span>
                            <select id="destination-select" name="province" class="form-select" style="width: 220px;">
                                <option value="">Tất cả tỉnh thành</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}" >{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-all" class="tab-pane fade show p-0 active">
                        <div id="destination-container" class="row g-4 d-flex">
                            <div class="col-xl-12">
                                <div id="loading" class="row g-4 ">
                                    @foreach($places as $place)
                                        {{--                                        {{dd($place)}}--}}
                                        <div class="col-lg-4 destination-item">
                                            <div class="destination-img">
                                                @foreach($place->placeMedia as $media)
                                                    @if($media->is_primary == 1)
                                                        <img class="img-fluid rounded w-100"
                                                             src="{{ asset($media->media) }}"
                                                             alt="{{ $place->name }}" data-a="{{$place->id}}">
                                                    @endif
                                                @endforeach
                                                <div class="destination-overlay p-4">
                                                    <h4 class="text-white mb-2 mt-3">{{$place->name}}</h4>
                                                    <a href="{{route('destination.detail', $place->id)}}" class="btn-hover text-white view-all-place-btn" data-province="">
                                                        View Detail <i class="fa fa-arrow-right ms-2"></i>
                                                    </a>
                                                </div>
                                                <div class="search-icon">
                                                    <a href="
                                                    @foreach($place->placeMedia as $media)
                                                    @if($media->is_primary == 1){{ asset($media->media) }}
                                                    @endif
                                                    @endforeach
                                                    " data-lightbox="destination-{{$place->id}}">
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
                            @if($have_more == 1)
                                <span id="get-url" data-url="{{ route('destination.more') }}"></span>
                                <div class="w-100 border-bottom margin-bottom-40"><a id="load-more" class="cursor-pointer text-href fw-semibold border-top  pt-2 pb-2 d-flex w-100 justify-content-center" data-next-page="1">Load More </a></div>
                            @else
                                <div class="w-100 border-bottom margin-bottom-40">
                                    <div class="d-flex border-top pt-2 pb-2 w-100 justify-content-center fw-semibold">No More Destination</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment End -->

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

    <!-- Chatbot -->
    @include('.frontend.component.chatbot')
    <!-- Chatbot End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>


@endsection
