@extends('frontend.layouts.layout')
@section('content')

    <body>

    <!-- Spinner Start -->
    <div id="spinner"
         class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid bg-primary px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                            class="fab fa-twitter fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                            class="fab fa-facebook-f fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                            class="fab fa-linkedin-in fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                            class="fab fa-instagram fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i
                            class="fab fa-youtube fw-normal"></i></a>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a href="#"><small class="me-3 text-light"><i class="fa fa-user me-2"></i>Register</small></a>
                    <a href="#"><small class="me-3 text-light"><i class="fa fa-sign-in-alt me-2"></i>Login</small></a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown"><small><i
                                    class="fa fa-home me-2"></i> My Dashboard</small></a>
                        <div class="dropdown-menu rounded">
                            <a href="#" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> My Profile</a>
                            <a href="#" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Inbox</a>
                            <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Notifications</a>
                            <a href="#" class="dropdown-item"><i class="fas fa-cog me-2"></i> Account Settings</a>
                            <a href="#" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Log Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

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
    <div class="container-fluid bg-breadcrumb"
         style="background: linear-gradient(rgba(19, 53, 123, 0.5), rgba(19, 53, 123, 0.5)), url({{ asset('images/breadcrumb-bg.jpg') }});">
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

    <div class="container-fluid destination py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h2 class="section-title px-3">{{$Destination->name}}</h2>
            </div>
            <div class="tab-class text-center">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="">
                                <div class="row d-flex">
                                    <div class="col-lg-7">
                                        <div class="destination-img">
                                            <div class="wrapper">
                                                <section class="gallery">
                                                    <button id="gallery-main-img" type="button"
                                                            class="gallery-main-img"><img
                                                            src="https://picsum.photos/id/27/600/600" alt="The Sea">
                                                    </button>
                                                    <div id="gallery-thumbs" class="gallery-thumbs">
                                                        <!-- thumnails loaded here --></div>
                                                </section>
                                            </div>
                                            <dialog id="slider-dialog">
                                                <section class="slider-wrapper">
                                                    <button type="button" btn-slider="prev" id="btn-prev">&lsaquo;
                                                    </button>
                                                    <button type="button" btn-slider="next">&rsaquo;</button>
                                                    <div class="slider-content">
                                                        <div id="slider" class="slider">
                                                            <!-- slideshow images loaded here --></div>
                                                    </div>
                                                </section>
                                                <button id="btn-dialog-close" class="btn-dialog-close">&#10005;</button>
                                            </dialog>
                                            <hr>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="container mt-5">

                                            </div>
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
                                                            <span class="score">4.2</span>
                                                            <div class="stars">
                                                                ★★★★☆
                                                            </div>
                                                        </div>
                                                        <div class="rating-bars col-lg-4">
                                                            <div class="rating-row">
                                                                <span>5 ★</span>
                                                                <div class="progress-bar"><div class="progress" style="width: 60%;"></div></div>
                                                                <span>60%</span>
                                                            </div>
                                                            <div class="rating-row">
                                                                <span>4 ★</span>
                                                                <div class="progress-bar"><div class="progress" style="width: 25%;"></div></div>
                                                                <span>25%</span>
                                                            </div>
                                                            <div class="rating-row">
                                                                <span>3 ★</span>
                                                                <div class="progress-bar"><div class="progress" style="width: 10%;"></div></div>
                                                                <span>10%</span>
                                                            </div>
                                                            <div class="rating-row">
                                                                <span>2 ★</span>
                                                                <div class="progress-bar"><div class="progress" style="width: 3%;"></div></div>
                                                                <span>3%</span>
                                                            </div>
                                                            <div class="rating-row">
                                                                <span>1 ★</span>
                                                                <div class="progress-bar"><div class="progress" style="width: 2%;"></div></div>
                                                                <span>2%</span>
                                                            </div>
                                                        </div>
                                                        <div class="recommend col-lg-5">
                                                            <!-- Percentages -->
                                                                <div class="circle-rating">62</div>
                                                            <p>Recommend working here to a friend</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-container">
                                                <div class="review  ">
                                                    <div class="user-info row">
                                                        <div class="avatar-review col-lg-1">
                                                            <img src="{{asset('/images/anime-girl-cyberpunk-sci-fi-cherry-blossom-ai-4k-wallpaper-uhdpaper.com-729@1@l.jpg')}}" alt="">
                                                        </div>
                                                        <div class="col-lg-11 text-start">
                                                            <strong>nhinhinhyyy</strong> ★★★★★
                                                            <span class="date ">2024-12-08 23:38 | Phân loại hàng: ĐEN và GHI, M (40-55kg)</span>
                                                            <p class="comment text-start fw-normal me-5 mt-3">
                                                                Tôi đã nhận được hàng rồi nhé
                                                                Giao hàng nhanh chóng
                                                                Đóng gói cẩn thận
                                                                Quần đẹp, đã sử dụng cảm thấy khá là OK</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review  ">
                                                    <div class="user-info row">
                                                        <div class="avatar-review col-lg-1">
                                                            <img src="{{asset('/images/anime-girl-cyberpunk-sci-fi-cherry-blossom-ai-4k-wallpaper-uhdpaper.com-729@1@l.jpg')}}" alt="">
                                                        </div>
                                                        <div class="col-lg-11 text-start">
                                                            <strong>nhinhinhyyy</strong> ★★★★★
                                                            <span class="date ">2024-12-08 23:38 | Phân loại hàng: ĐEN và GHI, M (40-55kg)</span>
                                                            <p class="comment text-start fw-normal me-5 mt-3">
                                                                Tôi đã nhận được hàng rồi nhé
                                                                Giao hàng nhanh chóng
                                                                Đóng gói cẩn thận
                                                                Quần đẹp, đã sử dụng cảm thấy khá là OK</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review  ">
                                                    <div class="user-info row">
                                                        <div class="avatar-review col-lg-1">
                                                            <img src="{{asset('/images/anime-girl-cyberpunk-sci-fi-cherry-blossom-ai-4k-wallpaper-uhdpaper.com-729@1@l.jpg')}}" alt="">
                                                        </div>
                                                        <div class="col-lg-11 text-start">
                                                            <strong>nhinhinhyyy</strong> ★★★★★
                                                            <span class="date ">2024-12-08 23:38 | Phân loại hàng: ĐEN và GHI, M (40-55kg)</span>
                                                            <p class="comment text-start fw-normal me-5 mt-3">
                                                                Tôi đã nhận được hàng rồi nhé
                                                                Giao hàng nhanh chóng
                                                                Đóng gói cẩn thận
                                                                Quần đẹp, đã sử dụng cảm thấy khá là OK</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review  ">
                                                    <div class="user-info row">
                                                        <div class="avatar-review col-lg-1">
                                                            <img src="{{asset('/images/anime-girl-cyberpunk-sci-fi-cherry-blossom-ai-4k-wallpaper-uhdpaper.com-729@1@l.jpg')}}" alt="">
                                                        </div>
                                                        <div class="col-lg-11 text-start">
                                                            <strong>nhinhinhyyy</strong> ★★★★★
                                                            <span class="date ">2024-12-08 23:38 | Phân loại hàng: ĐEN và GHI, M (40-55kg)</span>
                                                            <p class="comment text-start fw-normal me-5 mt-3">
                                                                Tôi đã nhận được hàng rồi nhé
                                                                Giao hàng nhanh chóng
                                                                Đóng gói cẩn thận
                                                                Quần đẹp, đã sử dụng cảm thấy khá là OK</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tour-box">
                <div class="tour-header mb-4">Lịch Trình và Giá Tour</div>
                <div class="d-flex gap-2 mb-4">
                    <button class="tour-btn active">18/03</button>
                    <button class="tour-btn">24/03</button>
                    <button class="tour-btn">07/04</button>
                    <button class="tour-btn">Tất cả</button>
                </div>
                <div class="tour-item tour-top mb-4">
                    <span>
                        <p class="mb-0 fw-bold">Người lớn </p>
                        > 9 tuổi
                    </span>
                    <span class="price">0</span>
                    <div>
                        <button class="btn btn-light me-2">-</button>
                        <span class="value">0</span>
                        <button class="btn btn-light ms-2">+</button>
                    </div>
                </div>

                <div class="tour-item tour-middle mb-4">
                    <span><p class="mb-0 fw-bold">Trẻ em</p>2 - 9 tuổi</span>
                    <span class="price">0</span>
                    <div>
                        <button class="btn btn-light me-2">-</button>
                        <span class="value">0</span>
                        <button class="btn btn-light ms-2">+</button>
                    </div>
                </div>

                <div class="tour-item tour-bottom mb-4">
                    <span><p class="mb-0 fw-bold">Trẻ em</p>< 2 tuổi</span>
                    <span class="price">0</span>
                    <div class="">
                        <button class="btn btn-light me-2">-</button>
                        <span class="value">0</span>
                        <button class="btn btn-light ms-2">+</button>
                    </div>
                </div>

                <div class="text-center mt-3 mb-4">
                    <p class="total-price">0 VNĐ</p>
                </div>

                <button class="btn-book btn btn-primary rounded-pill py-2 px-4 ">Yêu cầu đặt</button>
            </div>
        </div>
        <!-- Destination End -->

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
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i
            class="fa fa-arrow-up"></i></a>

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
            clearTimeout(autoSlide); // Dừng tự động khi bấm nút
            showSlides(slideIndex += n);
            autoSlide = setTimeout(() => changeSlide(1), 3000); // Tự động sau 3 giây
        }

        showSlides(slideIndex);
        autoSlide = setTimeout(() => changeSlide(1), 3000);
    </script>
@endsection
