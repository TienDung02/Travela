@extends('frontend.layouts.layout')
@section('content')


    <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Travela</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    @include('frontend.component.menu-top')
                </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb" style="background: linear-gradient(rgba(19, 53, 123, 0.5), rgba(19, 53, 123, 0.5)), url({{ asset('frontend/images/breadcrumb-bg.jpg') }});">
            <div class="container-fluid text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Tour Category</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-white">Category</li>
                </ol>
            </div>
        </div>
        <!-- Header End -->

    <!-- Explore Tour Start -->
    <div class="filter-overlay"></div>
    <div class="container-fluid ExploreTour py-5">
        <div class="container-fluid py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Explore Tour</h5>
                <h1 class="mb-4">The World</h1>
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum tempore nam, architecto doloremque velit explicabo? Voluptate sunt eveniet fuga eligendi! Expedita laudantium fugiat corrupti eum cum repellat a laborum quasi.
                </p>
            </div>
            <div class="row">
                <div class="col-lg-10 col-xl-10 col-xxl-8 mx-auto">
                    <!-- Cột filter bên trái -->
                    <button class="btn btn-outline-primary filter-toggle-btn d-lg-none mb-3" type="button" onclick="toggleFilterSidebar()">
                        <i class="fa fa-bars"></i> Filter
                    </button>
                    <div class="row">
                        <div class="col-lg-3 mb-4 filter-sidebar">
                            <div class="card p-3">
                                <form id="filterForm" method="GET" action="{{ route('tour.index') }}">
                                    @php
                                        $filterGroups = [
                                            [
                                                'title' => 'Price Range',
                                                'type' => 'range',
                                                'min' => 0,
                                                'max' => 24000000,
                                                'step' => 1000000,
                                                'id' => 'priceRange',
                                                'reset' => true,
                                            ],
                                            [
                                                'title' => 'Duration',
                                                'type' => 'number',
                                                'min' => 1,
                                                'max' => 30,
                                                'id' => 'durationInput',
                                            ],
                                            [
                                                'title' => 'Rating',
                                                'type' => 'checkbox',
                                                'choices' => [
                                                    ['id' => 'rate1', 'label' => '4-5⭐', 'value' => '4-5'],
                                                    ['id' => 'rate2', 'label' => '3-4⭐', 'value' => '3-4'],
                                                    ['id' => 'rate3', 'label' => '2-3⭐', 'value' => '2-3'],
                                                    ['id' => 'rate4', 'label' => '1-2⭐', 'value' => '1-2'],
                                                ],
                                                'showLimit' => 4,
                                            ],
                                        ];
                                    @endphp

                                    @foreach($filterGroups as $groupIdx => $group)
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="mb-0">{{ $group['title'] }}</h5>
                                            @if(!empty($group['reset']))
                                                <button type="button" class="btn btn-link p-0" style="font-size: 0.95rem;">Reset</button>
                                            @endif
                                        </div>
                                        @if($group['type'] === 'range')
                                        <div class="mb-3">
                                            <input
                                                type="range"
                                                class="form-range"
                                                min="{{ $group['min'] }}"
                                                max="{{ $group['max'] }}"
                                                step="{{ $group['step'] ?? 1 }}"
                                                value="{{ request('price', $group['min']) }}"
                                                id="{{ $group['id'] }}"
                                                name="price"
                                                oninput="updatePriceLabels()">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div id="minPrice">{{ number_format(request('price', $group['min']), 0, ',', '.') }}₫</div>
                                                <div id="maxPrice">24.000.000₫</div>
                                            </div>
                                        </div>
                                        @elseif($group['type'] === 'checkbox')
                                            @php
                                                $choices = $group['choices'];
                                                $showLimit = $group['showLimit'] ?? 3;
                                                $listId = 'filterList_' . $groupIdx;
                                                $btnId = 'seeAllBtn_' . $groupIdx;
                                            @endphp
                                            <ul class="list-group mb-3" id="{{ $listId }}">
                                                @foreach($choices as $i => $choice)
                                                    <li class="list-group-item {{ $group['title'] }}-item{{ $i >= $showLimit ? ' d-none' : '' }}">
                                                        @if($group['title'] === 'Rating')
                                                            @php $inputName = 'rating'; @endphp
                                                        @elseif($group['title'] === 'Tour Type')
                                                            @php $inputName = 'tour_type'; @endphp
                                                        @else
                                                            @php $inputName = Str::slug($group['title'], '_') ; @endphp
                                                        @endif
                                                        <input class="form-check-input me-1" type="checkbox" name="{{ $inputName }}[]" value="{{ $group['title'] === 'Tour Type' ? $choice['label'] : $choice['value'] ?? $choice['id'] }}" id="{{ $choice['id'] }}">
                                                        <label class="form-check-label" for="{{ $choice['id'] }}">{{ $choice['label'] }}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @if(count($choices) > $showLimit)
                                                <button type="button" class="btn btn-link p-0" id="{{ $btnId }}" onclick="toggleFilterChoices('{{ $listId }}', '{{ $btnId }}', {{ $showLimit }})" style="font-size: 0.95rem;">See all</button>
                                            @endif
                                        @elseif($group['type'] === 'number')
                                            <div class="mb-3 d-flex align-items-center gap-2">
                                                <button type="button" class="btn btn-outline-secondary px-2" onclick="changeDuration(-1, '{{ $group['id'] }}', {{ $group['min'] }}, {{ $group['max'] }})">-</button>
                                                <input
                                                    type="number"
                                                    class="form-control text-center"
                                                    style="width: 80px;"
                                                    min="{{ $group['min'] }}"
                                                    max="{{ $group['max'] }}"
                                                    id="{{ $group['id'] }}"
                                                    name="duration"
                                                    value="{{ request('duration', '') }}"
                                                >
                                                <button type="button" class="btn btn-outline-secondary px-2" onclick="changeDuration(1, '{{ $group['id'] }}', {{ $group['min'] }}, {{ $group['max'] }})">+</button>
                                                <span class="ms-2">ngày</span>
                                            </div>
                                        @endif
                                        @if(!$loop->last)
                                            <hr class="my-4">
                                        @endif
                                    @endforeach
                                    <button type="submit" class="btn btn-primary w-100 mt-2">Apply</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <span class="fw-semibold">{{ isset($tours) ? $tours->total() : 0 }}</span> kết quả
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="me-2">Sắp xếp theo:</span>
                                    <select class="form-select" name="sort" style="width:auto;display:inline-block;">
                                        <option value="">Mặc định</option>
                                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá thấp nhất</option>
                                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá cao nhất</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-4 flex-column">
                                @if(isset($tours) && count($tours))
                                    @foreach($tours as $tour)
                                        <div class="col-12">
                                            <div class="card h-100 shadow-sm border-0 flex-row align-items-center tour-card">
                                                {{-- Hình ảnh tour --}}
                                                <div class="position-relative tour-img-col" style="min-width:220px;max-width:220px;">
                                                    @php
                                                        $randomImg = asset('frontend/images/explore-tour-' . rand(1, 6) . '.jpg');
                                                    @endphp
                                                    <img src="{{ $randomImg }}" class="img-fluid rounded-start w-100" alt="{{ $tour->name }}">
                                                </div>
                                                <div class="card-body d-flex flex-column flex-grow-1 tour-info-col">
                                                    {{-- Tên tour, địa điểm, giá --}}
                                                    <h5 class="card-title mb-2">
                                                        <a href="#" class="text-decoration-none text-dark">{{ $tour->name }}</a>
                                                    </h5>
                                                    <div class="mb-2 text-muted small">
                                                        <i class="fa fa-map-marker-alt me-1"></i>
                                                        @if($tour->places && $tour->places->count())
                                                            {{ $tour->places->pluck('name')->join(', ') }}
                                                        @else
                                                            Địa điểm không xác định
                                                        @endif
                                                    </div>
                                                    <div class="mb-2">
                                                <span class="fw-bold" style="font-size: 1.5rem; color: #dc3545;">
                                                    {{ number_format($tour->price, 0, ',', '.') }}₫
                                                </span>
                                                    </div>
                                                    @php
                                                        $minDuration = $tour->packages->min('duration');
                                                        $maxDuration = $tour->packages->max('duration');
                                                    @endphp
                                                    {{-- Hiển thị khoảng thời gian --}}
                                                    <div class="mb-2">
                                                    <span class="badge bg-light text-dark">
                                                        @if($tour->total_duration)
                                                            {{ $tour->total_duration }} ngày
                                                        @else
                                                            N/A
                                                        @endif
                                                    </span>
                                                    </div>
                                                    <div class="mb-2 d-flex align-items-center flex-wrap gap-1">
                                                        @php
                                                            $avgRating = $tour->avg_rating ?? 0;
                                                            $fullStars = floor($avgRating);
                                                            $halfStar = ($avgRating - $fullStars) >= 0.5;
                                                        @endphp
                                                        {{-- Hiển thị 5 sao --}}
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $fullStars)
                                                                <i class="fas fa-star text-warning"></i>
                                                            @elseif($halfStar && $i == $fullStars + 1)
                                                                <i class="fas fa-star-half-alt text-warning"></i>
                                                            @else
                                                                <i class="far fa-star text-warning"></i>
                                                            @endif
                                                        @endfor

                                                        {{-- Số lượng đánh giá --}}
                                                        <span class="ms-2 text-muted">({{ $tour->reviews_count ?? 0 }} đánh giá)</span>

                                                        {{-- Trung bình rating --}}
                                                        @if($tour->avg_rating !== null)
                                                            <span class="ms-2 fw-semibold text-primary">{{ number_format($tour->avg_rating, 1) }}/5</span>
                                                        @endif
                                                    </div>
                                                    <p class="card-text flex-grow-1">{{ Str::limit($tour->description, 80) }}</p>
                                                    <a href="{{ route('tour.detail', $tour->id) }}" class="btn btn-primary w-100 mt-auto">Xem chi tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="alert alert-info text-center">Không có tour nào để hiển thị.</div>
                                    </div>
                                @endif
                            </div>
                            {{-- PHÂN TRANG --}}
                            @if(isset($tours) && method_exists($tours, 'links'))
                                <div class="mt-4 d-flex justify-content-center">
                                    {{ $tours->links('pagination::bootstrap-4') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Explore Tour End -->

        <!-- Subscribe Start -->
        <div class="container-fluid subscribe py-5">
            <div class="container-fluid text-center py-5">
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
            <div class="container-fluid py-5">
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
            <div class="container-fluid">
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
    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function updatePriceLabels() {
        var range = document.getElementById('priceRange');
        document.getElementById('minPrice').innerText = formatNumber(range.value) + '₫';
        document.getElementById('maxPrice').innerText = '24.000.000₫'; // Assuming max price is 24.000.000₫
    }
    // Initialize on page load
    updatePriceLabels();
    </script>
    <script>
        function togglePublicChoices() {
            var items = document.querySelectorAll('.public-choice-item');
            var btn = document.getElementById('seeAllBtn');
            var hidden = Array.from(items).some(item => item.classList.contains('d-none'));
            items.forEach(function(item, idx) {
                if(idx >= {{ $showLimit }}) {
                    item.classList.toggle('d-none');
                }
            });
            btn.textContent = hidden ? 'Hide' : 'See all';
        }
    </script>
    <script>
function toggleFilterChoices(listId, btnId, showLimit) {
    var items = document.querySelectorAll('#' + listId + ' li');
    var btn = document.getElementById(btnId);
    var hidden = Array.from(items).some((item, idx) => idx >= showLimit && item.classList.contains('d-none'));
    items.forEach(function(item, idx) {
        if(idx >= showLimit) {
            item.classList.toggle('d-none');
        }
    });
    btn.textContent = hidden ? 'Hide' : 'See all';
}
</script>
<script>
function updateTourList(html) {
    const parser = new DOMParser();
    const doc = parser.parseFromString(html, 'text/html');
    // Cập nhật danh sách tour
    const newTourList = doc.querySelector('.row.g-4.flex-column');
    if (newTourList) {
        document.querySelector('.row.g-4.flex-column').innerHTML = newTourList.innerHTML;
    }
    // Cập nhật phân trang
    const newPagination = doc.querySelector('.mt-4.d-flex.justify-content-center');
    const oldPagination = document.querySelector('.mt-4.d-flex.justify-content-center');
    if (oldPagination && newPagination) {
        oldPagination.innerHTML = newPagination.innerHTML;
    } else if (oldPagination) {
        oldPagination.innerHTML = '';
    }
    // Cập nhật số kết quả
    const newResultCount = doc.querySelector('.fw-semibold');
    const oldResultCount = document.querySelector('.fw-semibold');
    if (newResultCount && oldResultCount) {
        oldResultCount.innerHTML = newResultCount.innerHTML;
    }
}

// Xử lý filter AJAX
document.getElementById('filterForm').onsubmit = function(e) {
    e.preventDefault();
    const form = this;
    const params = new URLSearchParams(new FormData(form)).toString();

    fetch(form.action + '?' + params)
        .then(response => response.text())
        .then(html => {
            updateTourList(html);
            // Đóng filter-sidebar trên mobile
            if (window.innerWidth < 992) {
                document.querySelector('.filter-sidebar').classList.remove('open');
                document.querySelector('.filter-overlay').classList.remove('active');
            }
        });
};

// Xử lý phân trang AJAX
document.addEventListener('click', function(e) {
    const link = e.target.closest('.mt-4.d-flex.justify-content-center a');
    if (link) {
        e.preventDefault();
        fetch(link.href)
            .then(response => response.text())
            .then(html => updateTourList(html));
    }
});

// Xử lý sort giữ filter (nếu muốn AJAX cho sort)
document.getElementById('sortForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    // Lấy các filter hiện tại từ filterForm
    const filterForm = document.getElementById('filterForm');
    const filterData = new FormData(filterForm);
    // Thêm sort vào filterData
    const sortSelect = form.querySelector('select[name="sort"]');
    if (sortSelect) filterData.set('sort', sortSelect.value);
    const params = new URLSearchParams(filterData).toString();

    fetch(filterForm.action + '?' + params)
        .then(response => response.text())
        .then(html => updateTourList(html));
});
//Xử lý reset filter
document.querySelectorAll('.btn-link.p-0').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const filterForm = document.getElementById('filterForm');
        filterForm.reset(); // Reset form fields
        updatePriceLabels(); // Cập nhật nhãn giá
        // Gửi yêu cầu AJAX để cập nhật danh sách tour
        fetch(filterForm.action)
            .then(response => response.text())
            .then(html => {
                updateTourList(html);
                // Đóng filter-sidebar trên mobile
                if (window.innerWidth < 992) {
                    document.querySelector('.filter-sidebar').classList.remove('open');
                    document.querySelector('.filter-overlay').classList.remove('active');
                }
            });
    });
});
//Xử lý sắp xếp
document.querySelector('.form-select[name="sort"]')?.addEventListener('change', function() {
    const filterForm = document.getElementById('filterForm');
    const formData = new FormData(filterForm);
    formData.set('sort', this.value); // Đảm bảo giá trị sort được cập nhật
    const params = new URLSearchParams(formData).toString();
    fetch(filterForm.action + '?' + params)
        .then(response => response.text())
        .then(html => updateTourList(html));
});
function toggleFilterSidebar() {
    const sidebar = document.querySelector('.filter-sidebar');
    const overlay = document.querySelector('.filter-overlay');
    sidebar.classList.toggle('open');
    if (sidebar.classList.contains('open')) {
        overlay.classList.add('active');
    } else {
        overlay.classList.remove('active');
    }
}
// Đóng filter khi click overlay
document.querySelector('.filter-overlay').addEventListener('click', function() {
    document.querySelector('.filter-sidebar').classList.remove('open');
    this.classList.remove('active');
});
</script>
<script>
function changeDuration(delta, inputId, min, max) {
    var input = document.getElementById(inputId);
    var val = parseInt(input.value) || min;
    val += delta;
    if (val < min) val = min;
    if (val > max) val = max;
    input.value = val;
}
</script>
@endsection
