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
<div class="container-fluid bg-breadcrumb"
    style="background: linear-gradient(rgba(19, 53, 123, 0.5), rgba(19, 53, 123, 0.5)), url({{ asset('frontend/images/breadcrumb-bg.jpg') }});">
    <div class="container-fluid text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Travel Tour</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Tour</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<!-- Destination Start -->
<div class="container-fluid ExploreTour py-5">
    <div class="container-fluid py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h1 class="display-5 fw-bold text-primary">
                {{ $tour->name ?? 'Tên tour du lịch' }}
            </h1>
        </div>
        <div class="tab-class text-center col-lg-10 col-xl-10 col-xxl-8 mx-auto">
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <!-- Left Column: Tour Info & Image -->
                        <div class="col-lg-7">
                            <!-- Highlight Title -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <!-- Star Rating -->
                                    <div class="text-warning me-2">
                                        @php
                                            $avgRating = $tour->avg_rating ?? 0;
                                            $reviewCount = $tour->reviews_count ?? 0;
                                        @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($avgRating))
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="me-3">{{ number_format($avgRating, 1) }}/5</span>
                                    <span class="me-3">({{ $reviewCount }} đánh giá)</span>
                                </div>
                            </div>
                            <!-- Main Image -->
                            <div class="mb-4">
                                <img src="{{ $tour->image_url ?? asset('frontend/images/gallery-1.jpg') }}"
                                    alt="{{ $tour->name ?? 'Tour' }}"
                                    class="img-fluid rounded w-100 mb-3"
                                    style="object-fit:cover;max-height:400px;">
                            </div>
                            <!-- Tour Experience -->
                            <div class="my-4"></div>
                            <div class="card mb-4">
                                <div class="card-body text-start">
                                    <div class="mb-3 fw-semibold" style="font-size: 1.05rem;">Lịch trình chi tiết:</div>
                                    <ul class="list-unstyled">
                                        @php $currentDay = 1; @endphp
                                        @foreach($tour->places as $place)
                                            @php
                                                $duration = $place->pivot->duration_days ?? 1;
                                                $startDay = $currentDay;
                                                $endDay = $currentDay + $duration - 1;
                                            @endphp
                                            <li class="mb-3">
                                                <div>
                                                    <span class="fw-bold text-primary">
                                                        Ngày {{ $startDay }}{{ $duration > 1 ? ' - '.$endDay : '' }}
                                                    </span>
                                                    <span class="ms-2">({{ $duration }} ngày) - <b>{{ $place->name }}</b></span>
                                                </div>
                                                <div class="ms-4 text-muted small">
                                                    {{ $place->desc ?? 'Không có mô tả.' }}
                                                </div>
                                            </li>
                                            @php $currentDay += $duration; @endphp
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Right Column: Tour Details -->
                        <div class="col-lg-5">
                            <div class="card mb-3">
                                <div class="card-body text-center p-0">
                                    @if(!empty($tour->start_date))
                                        <div class="countdown-header py-2" style="background: linear-gradient(90deg, #f94f9c 0%, #ffb6e6 100%); border-radius: 8px 8px 0 0;">
                                            <span class="fw-bold text-white fs-5">KẾT THÚC TRONG:</span>
                                        </div>
                                        <div class="d-flex justify-content-center gap-2 countdown-timer-box py-3" id="countdown-timer"
                                            data-end="{{ \Carbon\Carbon::parse($tour->start_date)->toIso8601String() }}">
                                            <!-- Countdown timer will be rendered here by JS -->
                                        </div>
                                        <div class="px-3 pb-2">
                                            <div class="text-danger fw-semibold small mb-1">
                                                Đăng ký sớm, nhóm đông, khách cũ – Giảm ngay đến 3,5 triệu/khách
                                            </div>
                                            <div class="text-danger fw-semibold small">
                                                Mua 10 vé loạt tour hot tặng ngay 1 vé miễn phí – Trị giá đến 39 triệu
                                            </div>
                                        </div>
                                    @else
                                        <div class="countdown-header py-2" style="background: linear-gradient(90deg, #f94f9c 0%, #ffb6e6 100%); border-radius: 8px 8px 0 0;">
                                            <span class="fw-bold text-white fs-5">KẾT THÚC TRONG:</span>
                                        </div>
                                        <div class="d-flex justify-content-center gap-2 countdown-timer-box py-3">
                                            <div class="countdown-item">
                                                <div class="countdown-value">00</div>
                                                <div class="countdown-label">Ngày</div>
                                            </div>
                                            <div class="countdown-item">
                                                <div class="countdown-value">00</div>
                                                <div class="countdown-label">Giờ</div>
                                            </div>
                                            <div class="countdown-item">
                                                <div class="countdown-value">00</div>
                                                <div class="countdown-label">Phút</div>
                                            </div>
                                            <div class="countdown-item">
                                                <div class="countdown-value">00</div>
                                                <div class="countdown-label">Giây</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <span class="fw-bold" style="color: #f94f9c; font-size: 1.2rem;">
                                            {{ $tour->name ?? 'Tên tour du lịch' }}
                                        </span>
                                    </div>
                                    <!-- Tour Info Table -->
                                    <table class="table table-sm mb-0">
                                        <tr>
                                            <th>Thời gian</th>
                                            <td>{{ $tour->total_duration ?? 'Đang cập nhật' }} ngày</td>
                                        </tr>
                                        <tr>
                                            <th>Ngày khởi hành</th>
                                            <td>{{ $tour->start_date ? \Carbon\Carbon::parse($tour->start_date)->format('d/m/Y') : 'Đang cập nhật' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="mb-3" style="font-size: 1.05rem;">
                                        <span class="fw-semibold">Trải nghiệm:</span>
                                        <ul class="list-unstyled mt-2 mb-4">
                                            <li class="mb-1"><i class="fas fa-check text-primary me-2"></i>Tham quan thị trấn sương mù Sapa.</li>
                                            <li class="mb-1"><i class="fas fa-check text-primary me-2"></i>Checkin đỉnh Fansipan – nóc nhà Đông Dương.</li>
                                            <li class="mb-1"><i class="fas fa-check text-primary me-2"></i>Thưởng thức ẩm thực vùng cao Tây Bắc như: lợn cắp nách, lẩu cá hồi, rượu táo mèo, …</li>
                                        </ul>
                                    </div>
                                    <div class="text-center mt-3"></div>
                                        <a href="{{ route('booking.tour.create', ['id' => $tour->id]) }}" class="btn btn-primary">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End col-lg-5 -->
                    </div>
                    <!-- Reviews -->
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
                            <p class="text-muted">Chưa có đánh giá nào. Hãy là người đầu tiên để lại nhận xét!</p>
                        @endforelse

                        @if($reviews instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <div class="mt-4">
                                {{ $reviews->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('reviews.store', ['type' => 'tour', 'id' => $tour->id]) }}" method="POST">
                            @csrf
                            <div class="mb-2">
                                <label for="rating" class="form-label">Đánh giá:</label>
                                <select name="rating" id="rating" class="form-select" required>
                                    <option value="">Chọn số sao</option>
                                    @for($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}">{{ $i }} ★</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="comment" class="form-label">Bình luận:</label>
                                <textarea name="comment" id="comment" class="form-control" rows="3" required placeholder="Viết bình luận của bạn..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                        </form>
                    </div>
                    @if(isset($otherTours) && $otherTours->count())
                        <div class="container my-5">
                            <div class="row justify-content-center">
                                @foreach($otherTours as $item)
                                    <div class="col-md-3 mb-4">
                                        <div class="card h-100 shadow-sm">
                                            <img src="{{ $item->image_url ?? asset('frontend/images/gallery-1.jpg') }}" class="card-img-top" style="height:160px;object-fit:cover;" alt="{{ $item->name }}">
                                            <div class="card-body d-flex flex-column align-items-center">
                                                <div class="fw-semibold mb-2 text-center" style="font-size:1rem;">
                                                    {{ $item->name }}
                                                </div>
                                                <div class="mb-2 text-danger fw-bold" style="font-size:1.1rem;">
                                                    {{ number_format($item->price, 0, ',', '.') }}đ
                                                </div>
                                                <a href="{{ route('tour.detail', $item->id) }}" class="btn btn-outline-primary fw-bold">Xem thêm</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
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
            <p class="text-white mb-5">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum tempore
                nam, architecto doloremque velit explicabo? Voluptate sunt eveniet fuga eligendi! Expedita
                laudantium fugiat corrupti eum cum repellat a laborum quasi.
            </p>
            <div class="position-relative mx-auto">
                <input class="form-control border-primary rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                <button type="button" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2">
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
                <i class="fas fa-copyright me-2"></i>
                <a class="text-white" href="#">Your Site Name</a>, All right reserved.
            </div>
            <div class="col-md-6 text-center text-md-start">
                Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a>
                Distributed By <a href="https://themewagon.com">ThemeWagon</a>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top">
    <i class="fa fa-arrow-up"></i>
</a>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var timer = document.getElementById('countdown-timer');
    if (timer && timer.dataset.end) {
        var end = new Date(timer.getAttribute('data-end')).getTime();
        function pad(n) { return n < 10 ? '0' + n : n; }
        function renderCountdown(days, hours, minutes, seconds) {
            timer.innerHTML = `
                <div class="countdown-item">
                    <div class="countdown-value">${pad(days)}</div>
                    <div class="countdown-label">Ngày</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-value">${pad(hours)}</div>
                    <div class="countdown-label">Giờ</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-value">${pad(minutes)}</div>
                    <div class="countdown-label">Phút</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-value">${pad(seconds)}</div>
                    <div class="countdown-label">Giây</div>
                </div>
            `;
        }
        function updateCountdown() {
            var now = new Date().getTime();
            var distance = end - now;
            if (distance < 0) {
                timer.innerHTML = '<span class="text-danger fw-bold">Đã kết thúc</span>';
                clearInterval(interval);
                return;
            }
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            renderCountdown(days, hours, minutes, seconds);
        }
        updateCountdown();
        var interval = setInterval(updateCountdown, 1000);
    }
});
</script>
@endsection
