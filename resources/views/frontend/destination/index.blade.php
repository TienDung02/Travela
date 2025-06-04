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

    <!-- Destination Start -->
    <div class="container-fluid destination py-5">
        <div class="container-fluid py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Destination</h5>
            </div>
            <div class="tab-class text-center col-lg-10 col-xl-10 col-xxl-8 mx-auto">
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
                                                            <a href="#" class="btn-hover text-white view-all-place-btn" data-province="{{ $province }}">
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
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Helper
        function updateUrl(params) {
            const url = new URL(window.location.href);
            Object.entries(params).forEach(([k, v]) => {
                if (v === null) url.searchParams.delete(k);
                else url.searchParams.set(k, v);
            });
            return url;
        }

        // Tab handling (if any tab navigation exists)
        const defaultTab = 'all';
        const url = new URL(window.location.href);
        const urlParams = url.searchParams;
        let currentTab = urlParams.get('tab') || defaultTab;

        // Show correct tab if nav-pills exist
        const activeTab = document.querySelector(`.nav-pills a[data-tab="${currentTab}"]`);
        if (activeTab && typeof bootstrap !== 'undefined') new bootstrap.Tab(activeTab).show();

        // Tab click: update URL and reload
        document.querySelectorAll('.nav-pills a[data-tab]').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const t = tab.getAttribute('data-tab');
                window.location.href = updateUrl({tab: t, page: 1}).toString();
            });
        });

        // "View All Place" by province (on overlay)
        document.querySelectorAll('.view-all-place-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const province = btn.getAttribute('data-province') || '';
                // Đổi sang route all và truyền province
                const url = new URL("{{ route('destination.all') }}", window.location.origin);
                if (province) url.searchParams.set('province', province);
                url.searchParams.set('page', 1);
                window.location.href = url.toString();
            });
        });

        // Province select box
        const select = document.getElementById('destination-select');
        const title = document.getElementById('destination-title');
        if (select) {
            select.addEventListener('change', function() {
                const val = select.value;
                if (title) title.textContent = val ? val : 'All Place';
                this.form.submit(); // Server handles province param
            });
        }

        // "See All Place" button (if exists)
        const viewAllBtn = document.getElementById('view-all-place-btn');
        if (viewAllBtn) {
            viewAllBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = updateUrl({province: null, page: 1}).toString();
            });
        }

        // Client-side pagination (if destination-container exists)
        const container = document.getElementById('destination-container');
        const paginationEl = document.getElementById('pagination');
        if (container && paginationEl) {
            const items = Array.from(container.querySelectorAll('.destination-item'));
            const itemsPerPage = 9;
            const totalPages = Math.ceil(items.length / itemsPerPage);
            let currentPage = Math.min(Math.max(parseInt(urlParams.get('page')) || 1, 1), totalPages);

            function showPage(page) {
                currentPage = page;
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                items.forEach((el, i) => {
                    el.style.display = (i >= start && i < end) ? '' : 'none';
                });
                window.history.replaceState(null, '', updateUrl({page}).toString());
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
                const maxButtons = 5;
                if (totalPages <= maxButtons) {
                    for (let i=1; i<= totalPages; i++) {
                        paginationEl.appendChild(makeLi(i, i, {active: i===currentPage}));
                    }
                } else {
                    let pages = [];
                    pages.push(1);
                    if (currentPage > 3) pages.push('...');
                    let start = Math.max(2, currentPage - 1);
                    let end = Math.min(totalPages - 1, currentPage + 1);
                    for (let i = start; i <= end; i++) pages.push(i);
                    if (currentPage < totalPages - 2) pages.push('...');
                    pages.push(totalPages);
                    pages.forEach(p => {
                        if (p === '...') {
                            const li = document.createElement('li');
                            li.className = 'page-item disabled';
                            const span = document.createElement('span');
                            span.className = 'page-link';
                            span.textContent = '…';
                            li.appendChild(span);
                            paginationEl.appendChild(li);
                        } else {
                            paginationEl.appendChild(makeLi(p, p, {active: p===currentPage}));
                        }
                    });
                }
                // Next
                paginationEl.appendChild(makeLi(currentPage+1, '›', {disabled: currentPage===totalPages}));
            }
            showPage(currentPage);
        }
    });
    </script>

@endsection
