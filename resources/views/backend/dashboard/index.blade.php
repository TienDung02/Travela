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
                    <!-- Row --Revenue overview-->
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
                    <!--End Row -->
                    <!--Row -- Orders Summary-->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5>Total Orders</h5>
                                        <p class="h3 text-primary">{{ $orderCount }}</p>
                                    </div>
                                </div>
                                 <div class="card text-center">
                                    <div class="card-body">
                                        <h5>Total Orders Items</h5>
                                        <p class="h3 text-primary">{{ $totalOrderDetails}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5>Tour vs Package Orders Ratio</h5>
                                        <div id="order-ratio-chart" style="height: 250px;"></div>
                                        <div class="mt-2">
                                            <span class="badge bg-info">Tours: {{ $tourOrderCount }}</span>
                                            <span class="badge bg-success">Packages: {{ $packageOrderCount }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            new Chartist.Pie('#order-ratio-chart', {
                                labels: [
                                    'Tours ({{ $tourOrderCount }})',
                                    'Packages ({{ $packageOrderCount }})'
                                ],
                                series: [
                                    {{ $tourOrderCount }},
                                    {{ $packageOrderCount }}
                                ]
                            }, {
                                donut: true,
                                donutWidth: 60,
                                startAngle: 0,
                                showLabel: true
                            });
                        </script>

                    <!--End Row -->
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
                                                    <strong>{{ $package->name }}</strong> - {{ $package->order_count }} Bookings
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
                                                    <strong>{{ $tour->name }}</strong> - {{ $tour->order_count }} Bookings
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
                                                    <strong>{{ $place->name }}</strong> - {{ $place->visit_count }} Visits
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

                 
                    <!-- ============================================================== -->
                    <!-- End PAge Content -->
@endsection