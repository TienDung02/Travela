@extends('backend.layouts.layout')
@section('title', 'Dashboard')
@section('content')
    <style>
        .rating-bars {
    margin-top: 15px;
}

.rating-row {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.rating-row span {
    width: 30px;
}

.progress-bar {
    background: #eee;
    width: 100%;
    margin: 0 10px;
    height: 10px;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
}

.progress {
    background: #4caf50;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}
    </style>
     <!-- Row -->
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-8 col-md-7">
                            <div class="card">
                                <div class="card-block">
                                    <h3 class="card-title">Revenue Overview</h3>
                                    <select id="timePeriod" class="form-control w-25 mb-3">
                                        <option value="month" {{ $timePeriod == 'month' ? 'selected' : '' }}>Month</option>
                                        <option value="quarter" {{ $timePeriod == 'quarter' ? 'selected' : '' }}>Quarter</option>
                                        <option value="year" {{ $timePeriod == 'year' ? 'selected' : '' }}>Year</option>
                                    </select>
                                    <div class="chart-container" style="overflow-x: auto; overflow-y: hidden; white-space: nowrap;">
                                        <div id="revenue-chart" class="flex align-content-center justify-content-center" style="height:400px;min-width: 700px; max-width: 20000px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            // Pass PHP data to JavaScript
                            var revenueData = @json($revenueData);
                            console.log(@json($revenueData));
                            // Extract labels and series for the chart
                            var labels = revenueData.map(data => data.period);
                            var series = revenueData.map(data => (data.revenue) );

                            //Initialize Chartist.js
                            new Chartist.Bar('#revenue-chart', {
                                labels: labels,
                                series: [series]
                            }, {
                                axisX: {
                                    position: 'end',
                                    showGrid: false
                                },
                                axisY: {
                                    position: 'start',
                                    high: Math.max(...series) + 10,
                                    low: 0
                                },

                            });
                            // var revenueData = [
                            //     { period: '2025-01', revenue: 100 },
                            //     { period: '2025-02', revenue: 200 },
                            //     { period: '2025-03', revenue: 300 }
                            // ];
                            // console.log(revenueData);

                            // var labels = revenueData.map(data => data.period);
                            // var series = [revenueData.map(data => data.revenue)];

                            // new Chartist.Bar('#revenue-chart', {
                            //     labels: labels,
                            //     series: [series]
                            // }, {
                            //     axisX: {
                            //         position: 'end',
                            //         showGrid: false
                            //     },
                            //     axisY: {
                            //         position: 'start',
                            //         high: Math.max(...series[0]) + 10,
                            //         low: 0
                            //     },
                            //     plugins: [
                            //         Chartist.plugins.tooltip()
                            //     ]
                            // });
                            //Handle time period change
                            document.getElementById('timePeriod').addEventListener('change', function () {
                                window.location.href = '?time_period=' + this.value;
                            });
                        </script>
                       <div class="col-lg-4 col-md-5">
                            <div class="card">
                                <div class="card-block">
                                    <h3 class="card-title">Users Statistic</h3>
                                    <h6 class="card-subtitle">Where do users register and login from? (Facebook, Google, Local)	</h6>
                                    <div id="user-statistic-chart" style="height: 400px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <script>
                            // Pass provider data to JavaScript
                            var providerData = @json($providerData);

                            // Prepare data for Chartist
                            var data = {
                                labels: Object.keys(providerData).map(function (provider) {
                                    return provider.charAt(0).toUpperCase() + provider.slice(1) + ' (' + providerData[provider] + ')'; // Capitalize first letter and add user count to label
                                }),
                                series: Object.values(providerData)
                            };

                            var options = {
                                labelInterpolationFnc: function (value) {
                                    return value; // Display full label with user count
                                }
                            };

                            var responsiveOptions = [
                                ['screen and (min-width: 640px)', {

                                    labelInterpolationFnc: function (value) {
                                        return value;
                                    }
                                }],
                                ['screen and (min-width: 1024px)', {

                                }]
                            ];

                            // Initialize Chartist Pie Chart
                            new Chartist.Pie('#user-statistic-chart', data, options, responsiveOptions);
                        </script>
                    </div>
                    <!-- Row -- Packages, Tours, Places -->
                        <div class="row">
                            <!-- Top Packages -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-block">
                                        <h3 class="card-title">Top Packages</h3>
                                        <ul class="list-group">
                                            @foreach($topPackages as $package)
                                                <li class="list-group-item">
                                                    <strong>{{ $package->name }}</strong> - {{ $package->booking_count }} Bookings
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Top Tours -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-block">
                                        <h3 class="card-title">Top Tours</h3>
                                        <ul class="list-group">
                                            @foreach($topTours as $tour)
                                                <li class="list-group-item">
                                                    <strong>{{ $tour->name }}</strong> - {{ $tour->booking_count }} Bookings
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Top Places -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-block">
                                        <h3 class="card-title">Top Places</h3>
                                        <ul class="list-group">
                                            @foreach($topPlaces as $place)
                                                <li class="list-group-item">
                                                    <strong>{{ $place->location }}</strong> - {{ $place->visit_count }} Visits
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--End Row -->

                    <!--Row Customer rivew summary-->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-block">
                                            <h3 class="card-title">Customer Review Summary</h3>
                                            <div class="review-summary">
                                                <h4>Average Rating: {{ number_format($reviewSummary->average_rating, 1) }} ★</h4>
                                                <p>Total Reviews: {{ $reviewSummary->total_reviews }}</p>
                                                <div class="rating-bars">
                                                    <div class="rating-row">
                                                        <span>5★</span>
                                                        <div class="progress-bar">
                                                            <div class="progress"
                                                                style="width: {{ ($reviewSummary->five_star / $reviewSummary->total_reviews) * 100 }}%;">
                                                            </div>
                                                        </div>
                                                        <span>{{ $reviewSummary->five_star }}</span>
                                                    </div>
                                                    <div class="rating-row">
                                                        <span>4★</span>
                                                        <div class="progress-bar">
                                                            <div class="progress"
                                                                style="width: {{ ($reviewSummary->four_star / $reviewSummary->total_reviews) * 100 }}%;">
                                                            </div>
                                                        </div>
                                                        <span>{{ $reviewSummary->four_star }}</span>
                                                    </div>
                                                    <div class="rating-row">
                                                        <span>3★</span>
                                                        <div class="progress-bar">
                                                            <div class="progress"
                                                                style="width: {{ ($reviewSummary->three_star / $reviewSummary->total_reviews) * 100 }}%;">
                                                            </div>
                                                        </div>
                                                        <span>{{ $reviewSummary->three_star }}</span>
                                                    </div>
                                                    <div class="rating-row">
                                                        <span>2★</span>
                                                        <div class="progress-bar">
                                                            <div class="progress"
                                                                style="width: {{ ($reviewSummary->two_star / $reviewSummary->total_reviews) * 100 }}%;">
                                                            </div>
                                                        </div>
                                                        <span>{{ $reviewSummary->two_star }}</span>
                                                    </div>
                                                    <div class="rating-row">
                                                        <span>1★</span>
                                                        <div class="progress-bar">
                                                            <div class="progress"
                                                                style="width: {{ ($reviewSummary->one_star / $reviewSummary->total_reviews) * 100 }}%;">
                                                            </div>
                                                        </div>
                                                        <span>{{ $reviewSummary->one_star }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <!-- end row -->

                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-4 col-xlg-3 col-md-5">
                            <!-- Column -->
                            <div class="card">
    {{--                            <img class="card-img-top" src="../../../../../../../HK10/NT208/FE/template/assets/images/background/profile-bg.jpg" alt="Card image cap">--}}
                                <img class="card-img-top" src="{{asset('/backend/assets/images/background/profile-bg.jpg')}}" alt="Card image cap">
                                <div class="card-block little-profile text-center">
    {{--                                <div class="pro-img"><img src="../../../../../../../HK10/NT208/FE/template/assets/images/users/4.jpg" alt="user" /></div>--}}
                                    <div class="pro-img"><img src="{{asset('/backend/assets/images/users/4.jpg')}}" alt="user" /></div>
                                    <h3 class="m-b-0">Angela Dominic</h3>
                                    <p>Web Designer &amp; Developer</p>
                                    <a href="javascript:void(0)" class="m-t-10 waves-effect waves-dark btn btn-primary btn-md btn-rounded">Follow</a>
                                    <div class="row text-center m-t-20">
                                        <div class="col-lg-4 col-md-4 m-t-20">
                                            <h3 class="m-b-0 font-light">1099</h3><small>Articles</small></div>
                                        <div class="col-lg-4 col-md-4 m-t-20">
                                            <h3 class="m-b-0 font-light">23,469</h3><small>Followers</small></div>
                                        <div class="col-lg-4 col-md-4 m-t-20">
                                            <h3 class="m-b-0 font-light">6035</h3><small>Following</small></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="card">
                                <div class="card-block bg-info">
                                    <h4 class="text-white card-title">My Contacts</h4>
                                    <h6 class="card-subtitle text-white m-b-0 op-5">Checkout my contacts here</h6>
                                </div>
                                <div class="card-block">
                                    <div class="message-box contact-box">
                                        <h2 class="add-ct-btn"><button type="button" class="btn btn-circle btn-lg btn-success waves-effect waves-dark">+</button></h2>
                                        <div class="message-widget contact-widget">
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img">
    {{--                                                <img src="../../../../../../../HK10/NT208/FE/template/assets/images/users/1.jpg" alt="user" class="img-circle">--}}
                                                    <img src="{{asset('/backend/assets/images/users/1.jpg')}}" alt="user" class="img-circle">
                                                    <span class="profile-status online pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">info@wrappixel.com</span></div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img">
    {{--                                                <img src="../../../../../../../HK10/NT208/FE/template/assets/images/users/2.jpg" alt="user" class="img-circle">--}}
                                                    <img src="{{asset('/backend/assets/images/users/2.jpg')}}" alt="user" class="img-circle">
                                                    <span class="profile-status busy pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Sonu Nigam</h5> <span class="mail-desc">pamela1987@gmail.com</span></div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <span class="round">A</span> <span class="profile-status away pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Arijit Sinh</h5> <span class="mail-desc">cruise1298.fiplip@gmail.com</span></div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img">
    {{--                                                <img src="../../../../../../../HK10/NT208/FE/template/assets/images/users/4.jpg" alt="user" class="img-circle">--}}
                                                    <img src="{{asset('/backend/assets/images/users/4.jpg')}}" alt="user" class="img-circle">
                                                    <span class="profile-status offline pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">kat@gmail.com</span></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xlg-9 col-md-7">
                            <div class="card">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs profile-tab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Activity</a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profile</a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                        <div class="card-block">
                                            <div class="profiletimeline">
                                                <div class="sl-item">
                                                    <div class="sl-left">
    {{--                                                    <img src="../../../../../../../HK10/NT208/FE/template/assets/images/users/1.jpg" alt="user" class="img-circle">--}}
                                                        <img src="{{asset('/backend/assets/images/users/1.jpg')}}" alt="user" class="img-circle">
                                                    </div>
                                                    <div class="sl-right">
                                                        <div><a href="#" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                            <p>assign a new task <a href="#"> Design weblayout</a></p>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 m-b-20">
    {{--                                                                <img src="../../../../../../../HK10/NT208/FE/template/assets/images/big/img1.jpg" alt="user" class="img-responsive radius">--}}
                                                                    <img src="{{asset('/backend/assets/images/big/img1.jpg')}}" alt="user" class="img-responsive radius">
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 m-b-20">
    {{--                                                                <img src="../../../../../../../HK10/NT208/FE/template/assets/images/big/img2.jpg" alt="user" class="img-responsive radius">--}}
                                                                    <img src="{{asset('/backend/assets/images/big/img2.jpg')}}" alt="user" class="img-responsive radius">
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 m-b-20">
    {{--                                                                <img src="../../../../../../../HK10/NT208/FE/template/assets/images/big/img3.jpg" alt="user" class="img-responsive radius">--}}
                                                                    <img src="{{asset('/backend/assets/images/big/img3.jpg')}}" alt="user" class="img-responsive radius">
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 m-b-20">
    {{--                                                                <img src="../../../../../../../HK10/NT208/FE/template/assets/images/big/img4.jpg" alt="user" class="img-responsive radius">--}}
                                                                    <img src="{{asset('/backend/assets/images/big/img4.jpg')}}" alt="user" class="img-responsive radius">
                                                                </div>
                                                            </div>
                                                            <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="sl-item">
                                                    <div class="sl-left">
    {{--                                                    <img src="../../../../../../../HK10/NT208/FE/template/assets/images/users/2.jpg" alt="user" class="img-circle">--}}
                                                        <img src="{{asset('/backend/assets/images/users/2.jpg')}}" alt="user" class="img-circle">
                                                    </div>
                                                    <div class="sl-right">
                                                        <div> <a href="#" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                            <div class="m-t-20 row">
                                                                <div class="col-md-3 col-xs-12">
    {{--                                                                <img src="../../../../../../../HK10/NT208/FE/template/assets/images/big/img1.jpg" alt="user" class="img-responsive radius">--}}
                                                                    <img src="{{asset('/backend/assets/images/big/img1.jpg')}}" alt="user" class="img-responsive radius">
                                                                </div>
                                                                <div class="col-md-9 col-xs-12">
                                                                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. </p> <a href="#" class="btn btn-success"> Design weblayout</a></div>
                                                            </div>
                                                            <div class="like-comm m-t-20"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="sl-item">
                                                    <div class="sl-left">
    {{--                                                    <img src="../../../../../../../HK10/NT208/FE/template/assets/images/users/3.jpg" alt="user" class="img-circle">--}}
                                                        <img src="{{asset('/backend/assets/images/users/3.jpg')}}" alt="user" class="img-circle">
                                                    </div>
                                                    <div class="sl-right">
                                                        <div><a href="#" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                            <p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper </p>
                                                        </div>
                                                        <div class="like-comm m-t-20"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="sl-item">
                                                    <div class="sl-left">
    {{--                                                    <img src="../../../../../../../HK10/NT208/FE/template/assets/images/users/4.jpg" alt="user" class="img-circle"> --}}
                                                        <img src="{{asset('/backend/assets/images/users/4.jpg')}}" alt="user" class="img-circle">
                                                    </div>
                                                    <div class="sl-right">
                                                        <div><a href="#" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                            <blockquote class="m-t-10">
                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                                            </blockquote>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--second tab-->
                                    <div class="tab-pane" id="profile" role="tabpanel">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                                    <br>
                                                    <p class="text-muted">Johnathan Deo</p>
                                                </div>
                                                <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                                    <br>
                                                    <p class="text-muted">(123) 456 7890</p>
                                                </div>
                                                <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                                    <br>
                                                    <p class="text-muted">johnathan@admin.com</p>
                                                </div>
                                                <div class="col-md-3 col-xs-6"> <strong>Location</strong>
                                                    <br>
                                                    <p class="text-muted">London</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <p class="m-t-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries </p>
                                            <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                            <h4 class="font-medium m-t-30">Skill Set</h4>
                                            <hr>
                                            <h5 class="m-t-30">Wordpress <span class="pull-right">80%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                            </div>
                                            <h5 class="m-t-30">HTML 5 <span class="pull-right">90%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                            </div>
                                            <h5 class="m-t-30">jQuery <span class="pull-right">50%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                            </div>
                                            <h5 class="m-t-30">Photoshop <span class="pull-right">70%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="settings" role="tabpanel">
                                        <div class="card-block">
                                            <form class="form-horizontal form-material">
                                                <div class="form-group">
                                                    <label class="col-md-12">Full Name</label>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-email" class="col-md-12">Email</label>
                                                    <div class="col-md-12">
                                                        <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Password</label>
                                                    <div class="col-md-12">
                                                        <input type="password" value="password" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Phone No</label>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Message</label>
                                                    <div class="col-md-12">
                                                        <textarea rows="5" class="form-control form-control-line"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-12">Select Country</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control form-control-line">
                                                            <option>London</option>
                                                            <option>India</option>
                                                            <option>Usa</option>
                                                            <option>Canada</option>
                                                            <option>Thailand</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <button class="btn btn-success">Update Profile</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End PAge Content -->
@endsection