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
                <h2 class="section-title px-3">{{$Place->name}}</h2>
            </div>
            <div class="tab-class text-center">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="row d-flex">
                                <div class="col-lg-7">
                                    <div class="destination-img">
                                        <div class="wrapper">
                                            <section class="gallery">
                                                {{-- ẢNH CHÍNH --}}
                                                <button id="gallery-main-img" type="button" class="gallery-main-img">
                                                    @if($primaryMedia->media_type === 'image')
                                                        <img src="{{ asset($primaryMedia->media) }}" alt="Primary Media"
                                                            id="main-img-preview">
                                                    @elseif($primaryMedia->media_type === 'video')
                                                        <video src="{{ asset($primaryMedia->media) }}" controls
                                                            id="main-img-preview" width="100px" height="400px"></video>
                                                    @endif
                                                </button>

                                                {{-- THUMBNAILS --}}
                                                <div class="thumbs-container-wrapper">
                                                    <button id="thumb-prev" class="thumb-nav-btn">&#10094;</button>

                                                    <div id="gallery-thumbs" class="gallery-thumbs">
                                                        <button class="thumb-btn"
                                                            onclick="changeMainMedia('{{ asset($primaryMedia->media) }}', '{{ $primaryMedia->media_type }}')">
                                                            @if($primaryMedia->media_type === 'image')
                                                                <img src="{{ asset($primaryMedia->media) }}">
                                                            @elseif($primaryMedia->media_type === 'video')
                                                                <video src="{{ asset($primaryMedia->media) }}"></video>
                                                            @endif
                                                        </button>
                                                        @foreach($otherMedia as $media)
                                                            <button class="thumb-btn"
                                                                onclick="changeMainMedia('{{ asset($media->media) }}','{{ $media->media_type }}')">
                                                                @if($media->media_type === 'image')
                                                                    <img src="{{ asset($media->media) }}" width="25%" height="25%">
                                                                @elseif($media->media_type === 'video')
                                                                    <video src="{{ asset($media->media) }}" width="25%"
                                                                        height="25%"></video>
                                                                @endif
                                                            </button>
                                                        @endforeach
                                                    </div>

                                                    <button id="thumb-next" class="thumb-nav-btn">&#10095;</button>
                                                </div>
                                            </section>

                                            {{-- SLIDESHOW (nếu bạn muốn dùng) --}}
                                            <dialog id="slider-dialog">
                                                <section class="slider-wrapper">
                                                    <button type="button" btn-slider="prev" id="btn-prev">&lsaquo;</button>
                                                    <button type="button" btn-slider="next">&rsaquo;</button>
                                                    <div class="slider-content">
                                                        <div id="slider" class="slider">
                                                            @foreach($otherMedia as $media)
                                                                @if($media->media_type === 'image')
                                                                    <div class="slide"><img src="{{ asset($media->media) }}"
                                                                            alt="Media" class="slider-item"></div>
                                                                @elseif($media->media_type === 'video')
                                                                    <div class="slide"><video src="{{ asset($media->media) }}"
                                                                            controls class="slider-item"></video></div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </section>
                                                <button id="btn-dialog-close" class="btn-dialog-close">&#10005;</button>
                                            </dialog>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row d-flex">
                                        <div class="col-lg-7">
                                            <div class="title">
                                                Trải nghiệm thú vị trong tour

                                            </div>
                                            <div>
                                                - Khám phá Tháp Eiffel và Du thuyền sông Seine – Biểu tượng nước Pháp và
                                                trải nghiệm ngắm cảnh Paris thơ mộng.

                                                - Tham quan làng Giethoorn – Venice của Hà Lan, nơi giao thông chỉ có
                                                kênh đào và thuyền.

                                                - Chiêm ngưỡng hoa tulip tại Keukenhof – Vườn hoa lớn nhất thế giới với
                                                hàng triệu bông hoa rực rỡ.

                                                - Quảng trường Grand Place – Di sản thế giới tại Brussels, trung tâm văn
                                                hóa và kiến trúc châu Âu.

                                                - Nhà thờ Cologne và các biểu tượng nước Đức – Kiến trúc Gothic và di
                                                sản UNESCO đáng kinh ngạc.
                                            </div>
                                        </div>
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7">
                                            <div class="title">
                                                Trải nghiệm thú vị trong tour

                                            </div>
                                            <div>
                                                - Khám phá Tháp Eiffel và Du thuyền sông Seine – Biểu tượng nước Pháp và
                                                trải nghiệm ngắm cảnh Paris thơ mộng.

                                                - Tham quan làng Giethoorn – Venice của Hà Lan, nơi giao thông chỉ có
                                                kênh đào và thuyền.

                                                - Chiêm ngưỡng hoa tulip tại Keukenhof – Vườn hoa lớn nhất thế giới với
                                                hàng triệu bông hoa rực rỡ.

                                                - Quảng trường Grand Place – Di sản thế giới tại Brussels, trung tâm văn
                                                hóa và kiến trúc châu Âu.

                                                - Nhà thờ Cologne và các biểu tượng nước Đức – Kiến trúc Gothic và di
                                                sản UNESCO đáng kinh ngạc.
                                            </div>
                                        </div>
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7">
                                            <div class="title">
                                                Trải nghiệm thú vị trong tour

                                            </div>
                                            <div>
                                                - Khám phá Tháp Eiffel và Du thuyền sông Seine – Biểu tượng nước Pháp và
                                                trải nghiệm ngắm cảnh Paris thơ mộng.

                                                - Tham quan làng Giethoorn – Venice của Hà Lan, nơi giao thông chỉ có
                                                kênh đào và thuyền.

                                                - Chiêm ngưỡng hoa tulip tại Keukenhof – Vườn hoa lớn nhất thế giới với
                                                hàng triệu bông hoa rực rỡ.

                                                - Quảng trường Grand Place – Di sản thế giới tại Brussels, trung tâm văn
                                                hóa và kiến trúc châu Âu.

                                                - Nhà thờ Cologne và các biểu tượng nước Đức – Kiến trúc Gothic và di
                                                sản UNESCO đáng kinh ngạc.
                                            </div>
                                        </div>
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7">
                                            <div class="title">
                                                Trải nghiệm thú vị trong tour

                                            </div>
                                            <div>
                                                - Khám phá Tháp Eiffel và Du thuyền sông Seine – Biểu tượng nước Pháp và
                                                trải nghiệm ngắm cảnh Paris thơ mộng.

                                                - Tham quan làng Giethoorn – Venice của Hà Lan, nơi giao thông chỉ có
                                                kênh đào và thuyền.

                                                - Chiêm ngưỡng hoa tulip tại Keukenhof – Vườn hoa lớn nhất thế giới với
                                                hàng triệu bông hoa rực rỡ.

                                                - Quảng trường Grand Place – Di sản thế giới tại Brussels, trung tâm văn
                                                hóa và kiến trúc châu Âu.

                                                - Nhà thờ Cologne và các biểu tượng nước Đức – Kiến trúc Gothic và di
                                                sản UNESCO đáng kinh ngạc.
                                            </div>
                                        </div>
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7">
                                            <div class="title">
                                                Trải nghiệm thú vị trong tour

                                            </div>
                                            <div>
                                                - Khám phá Tháp Eiffel và Du thuyền sông Seine – Biểu tượng nước Pháp và
                                                trải nghiệm ngắm cảnh Paris thơ mộng.

                                                - Tham quan làng Giethoorn – Venice của Hà Lan, nơi giao thông chỉ có
                                                kênh đào và thuyền.

                                                - Chiêm ngưỡng hoa tulip tại Keukenhof – Vườn hoa lớn nhất thế giới với
                                                hàng triệu bông hoa rực rỡ.

                                                - Quảng trường Grand Place – Di sản thế giới tại Brussels, trung tâm văn
                                                hóa và kiến trúc châu Âu.

                                                - Nhà thờ Cologne và các biểu tượng nước Đức – Kiến trúc Gothic và di
                                                sản UNESCO đáng kinh ngạc.
                                            </div>
                                        </div>
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7">
                                            <div class="title">
                                                Trải nghiệm thú vị trong tour

                                            </div>
                                            <div>
                                                - Khám phá Tháp Eiffel và Du thuyền sông Seine – Biểu tượng nước Pháp và
                                                trải nghiệm ngắm cảnh Paris thơ mộng.

                                                - Tham quan làng Giethoorn – Venice của Hà Lan, nơi giao thông chỉ có
                                                kênh đào và thuyền.

                                                - Chiêm ngưỡng hoa tulip tại Keukenhof – Vườn hoa lớn nhất thế giới với
                                                hàng triệu bông hoa rực rỡ.

                                                - Quảng trường Grand Place – Di sản thế giới tại Brussels, trung tâm văn
                                                hóa và kiến trúc châu Âu.

                                                - Nhà thờ Cologne và các biểu tượng nước Đức – Kiến trúc Gothic và di
                                                sản UNESCO đáng kinh ngạc.
                                            </div>
                                        </div>

                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7">
                                            <hr>
                                            <div class="title">
                                                <h5 class="section-title px-3">Đánh giá</h5>
                                            </div>
                                            <div>
                                                <div class="review-container">
                                                    <h2>Overall rating</h2>
                                                    <div class="rating-summary row d-flex">
                                                        <div class="rating-score col-lg-2">
                                                            <span class="score">{{ $averageRating }}</span>
                                                            <div class="stars">
                                                                {{-- Hiển thị ★ và ☆ dựa trên average, ví dụ làm đơn giản:
                                                                --}}
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    @if($i <= floor($averageRating))
                                                                        ★
                                                                    @elseif($i - $averageRating < 1)
                                                                        {{-- làm nửa sao nếu muốn: ★☆ --}}
                                                                        ⯨
                                                                    @else
                                                                        ☆
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                            <div class="text-muted">{{ $totalReviews }} reviews</div>
                                                        </div>
                                                        <div class="rating-bars col-lg-4">
                                                            @for($i = 5; $i >= 1; $i--)
                                                                <div class="rating-row">
                                                                    <span>{{ $i }} ★</span>
                                                                    <div class="progress-bar">
                                                                        <div class="progress"
                                                                            style="width: {{ $percentages[$i] }}%;"></div>
                                                                    </div>
                                                                    <span>{{ $percentages[$i] }}%</span>
                                                                </div>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="review-container" id="reviews-container">
                                                @forelse($reviews as $review)
                                                    <div class="review mb-4">
                                                        <div class="user-info row align-items-start">
                                                            <div class="avatar-review col-lg-1 col-2">
                                                                <img src="{{ $review->user->avatar_url ?? asset('frontend/images/default-avatar.png') }}"
                                                                    alt="{{ $review->user->name ?? 'Người dùng' }}"
                                                                    class="img-fluid rounded-circle">
                                                            </div>

                                                            <div class="col-lg-11 col-10 text-start">
                                                                <strong>{{ $review->user->name ?? 'Người dùng' }}</strong>

                                                                <div class="text-warning d-inline-block">
                                                                    @for($i = 1; $i <= 5; $i++)
                                                                        @if($i <= $review->rating)
                                                                            ★
                                                                        @else
                                                                            ☆
                                                                        @endif
                                                                    @endfor
                                                                </div>

                                                                <span class="date text-muted d-block mt-1">
                                                                    {{ $review->created_at->format('Y-m-d H:i') }}
                                                                    @if(!empty($review->variant))
                                                                        | Phân loại hàng: {{ $review->variant }}
                                                                    @endif
                                                                </span>

                                                                <p class="comment fw-normal mt-2">
                                                                    {{ $review->comment }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <p class="text-muted">Chưa có đánh giá nào. Hãy là người đầu tiên để lại
                                                        nhận xét!</p>
                                                @endforelse

                                                @if($reviews instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                                    <div class="mt-4">
                                                        {{ $reviews->links() }}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Destination End -->
    <div class="clearfix"></div>
    <!-- Subscribe Start -->
    <div class="container-fluid subscribe py-5">
        <div class="container text-center py-5">
            <div class="mx-auto text-center" style="max-width: 900px;">
                <h5 class="subscribe-title px-3">Subscribe</h5>
                <h1 class="text-white mb-4">Our Newsletter</h1>
                <p class="text-white mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum tempore
                    nam, architecto doloremque velit explicabo? Voluptate sunt eveniet fuga eligendi! Expedita
                    laudantium fugiat corrupti eum cum repellat a laborum quasi.
                </p>
                <div class="position-relative mx-auto">
                    <input class="form-control border-primary rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                        placeholder="Your email">
                    <button type="button"
                        class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2">
                        Subscribe
                    </button>
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
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i
                                    class="fab fa-instagram"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
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
                    <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All
                    right reserved.
                </div>
                <div class="col-md-6 text-center text-md-start">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                        href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <script>
        let slideIndex = 0;
        let slides = document.querySelectorAll(".slide");
        let autoSlide;

        function showSlides(n) {
            if (n >= slides.length) slideIndex = 0;
            if (n < 0) slideIndex = slides.length - 1;

            slides.forEach(slide => slide.style.display = "none");
            slides[slideIndex].style.display = "block";
        }

        function changeSlide(n) {
            clearTimeout(autoSlide);
            showSlides(slideIndex += n);
            autoSlide = setTimeout(() => changeSlide(1), 3000);
        }

        // Khởi động slideshow
        if (slides.length > 0) {
            showSlides(slideIndex);
            autoSlide = setTimeout(() => changeSlide(1), 3000);
        }

        // Đổi ảnh chính khi click thumbnail
        function changeMainMedia(url, type) {
            const main = document.getElementById('main-img-preview');
            if (type === 'image') {
                main.outerHTML = `<img src="${url}" alt="Media" id="main-img-preview">`;
            } else if (type === 'video') {
                main.outerHTML = `<video src="${url}" controls id="main-img-preview"></video>`;
            }

            // Optional: cập nhật slideIndex nếu ảnh nằm trong slides
            slides.forEach((slide, index) => {
                const mediaSrc = slide.querySelector('img, video')?.src;
                if (mediaSrc === url) {
                    slideIndex = index;
                    showSlides(slideIndex);
                }
            });
        }
    </script>
    <script>
document.addEventListener('DOMContentLoaded', () => {
    const thumbs    = document.getElementById('gallery-thumbs');
    const prevBtn   = document.getElementById('thumb-prev');
    const nextBtn   = document.getElementById('thumb-next');

    const thumbWidth = 80; // px
    const thumbGap   = 8;  // px

    const minVisible = 3;  // ít nhất 3 thumb (trên các màn rất nhỏ)
    const maxVisible = 6;  // nhiều nhất 6 thumb (trên laptop)

    let currentIndex = 0;
    let thumbVisible = 0;

    function calcVisibleCount() {
        const containerWidth = thumbs.clientWidth + thumbGap;
        return Math.floor(containerWidth / (thumbWidth + thumbGap));
    }

    function updateButtons() {
        const allThumbs = Array.from(document.querySelectorAll('.thumb-btn'))
            .filter(btn => btn.offsetParent !== null);
        const total = allThumbs.length;

        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex + thumbVisible >= total;

        if (total <= thumbVisible) {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
            thumbs.style.justifyContent = 'center';
        } else {
            prevBtn.style.display = '';
            nextBtn.style.display = '';
            thumbs.style.justifyContent = 'start';
        }
    }

    function onPrev() {
        if (currentIndex > 0) {
            currentIndex = Math.max(0, currentIndex - 1);
            thumbs.scrollBy({ left: -(thumbWidth + thumbGap), behavior: 'smooth' });
        }
        updateButtons();
    }

    function onNext() {
        const allThumbs = Array.from(document.querySelectorAll('.thumb-btn'))
            .filter(btn => btn.offsetParent !== null);
        if (currentIndex + thumbVisible < allThumbs.length) {
            currentIndex = Math.min(allThumbs.length - thumbVisible, currentIndex + 1);
            thumbs.scrollBy({ left: thumbWidth + thumbGap, behavior: 'smooth' });
        }
        updateButtons();
    }

    function onResize() {
        // Tính bao nhiêu thumbnail có thể hiện thị, rồi giới hạn trong khoảng min–max
        const count = calcVisibleCount();
        thumbVisible = Math.min(Math.max(count, minVisible), maxVisible);

        // Đảm bảo currentIndex không vượt
        const allThumbs = document.querySelectorAll('.thumb-btn');
        const maxIndex = Math.max(0, allThumbs.length - thumbVisible);
        if (currentIndex > maxIndex) currentIndex = maxIndex;

        updateButtons();
    }

    // Gán sự kiện
    prevBtn.addEventListener('click', onPrev);
    nextBtn.addEventListener('click', onNext);
    window.addEventListener('resize', onResize);

    // Ẩn thumbnail nếu load lỗi
    document.querySelectorAll('.thumb-btn img, .thumb-btn video')
        .forEach(media => {
            media.onerror = () => {
                media.parentElement.style.display = 'none';
                onResize();
            };
        });

    // Khởi tạo
    onResize();
});
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('reviews-container')
                .addEventListener('click', function (e) {
                    const a = e.target.closest('#reviews-container .pagination a');
                    if (!a) return;
                    e.preventDefault();

                    const url = a.href;
                    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(r => r.text())
                        .then(html => {
                            // parse cả trang mới
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            // lấy chính xác phần reviews-container
                            const newReviews = doc.querySelector('#reviews-container').innerHTML;
                            // chèn lại
                            document.querySelector('#reviews-container').innerHTML = newReviews;
                            // đẩy URL mới vào history
                            history.pushState(null, '', url);
                        });
                });

            // handle back/forward
            window.addEventListener('popstate', function () {
                const url = location.href;
                fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(r => r.text())
                    .then(html => {
                        const doc = new DOMParser().parseFromString(html, 'text/html');
                        document.querySelector('#reviews-container').innerHTML
                            = doc.querySelector('#reviews-container').innerHTML;
                    });
            });
        });
    </script>

<style>
.col-lg-7 {
    width: 100%;
    max-width: 100%;
    overflow: hidden;
}
</style>







@endsection