<x-app-layout>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            @include('admin.sidebar')
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    @include('admin.topbar')
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        </div>

                        <!-- Content Row -->
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Users</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-user fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Pending order</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ $pendingOrdersCount }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Total amount</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Content Row -->

                        <div class="row">
                            <!-- Area Chart -->
                            <div class="col-xl-8 col-lg-7">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="container">
                                        <h5 class="mt-3">ORDER BY PERIOD</h5>
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="card mt-3">

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h4>Total Orders by Week</h4>
                                                            <canvas id="ordersByWeekChart" width="400"
                                                                height="200"></canvas>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h4>Total Orders by Month</h4>
                                                            <canvas id="ordersByMonthChart" width="400"
                                                                height="200"></canvas>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h4>Total Orders by Year</h4>
                                                            <canvas id="ordersByYearChart" width="400"
                                                                height="200"></canvas>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="chart-area">
                                            <canvas id="myAreaChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pie Chart -->
                            <div class="col-xl-4 col-lg-5">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Order Trends by Product</h6>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="dropdown-header">Dropdown Header:</div>
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="chart-pie pt-2 pb-2 ms-5">
                                            <canvas id="orderTrendsByProductChart"></canvas>
                                        </div>
                                        <div class="mt-4 text-center small">
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-primary"></i> Direct
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-success"></i> Social
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-info"></i> Referral
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- container-fluid -->

                </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

    </body>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctxWeek = document.getElementById('ordersByWeekChart').getContext('2d');
        var ordersByWeekChart = new Chart(ctxWeek, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($totalOrdersByWeek as $order)
                        '{{ $order->year }}-W{{ $order->week }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Total Orders',
                    data: [
                        @foreach ($totalOrdersByWeek as $order)
                            {{ $order->total_orders }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxMonth = document.getElementById('ordersByMonthChart').getContext('2d');
        var ordersByMonthChart = new Chart(ctxMonth, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($totalOrdersByMonth as $order)
                        '{{ $order->year }}-{{ $order->month }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Total Orders',
                    data: [
                        @foreach ($totalOrdersByMonth as $order)
                            {{ $order->total_orders }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxYear = document.getElementById('ordersByYearChart').getContext('2d');
        var ordersByYearChart = new Chart(ctxYear, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($totalOrdersByYear as $order)
                        '{{ $order->year }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Total Orders',
                    data: [
                        @foreach ($totalOrdersByYear as $order)
                            {{ $order->total_orders }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    {{-- Order Trends by Product --}}
    <script>
        var ctx = document.getElementById('orderTrendsByProductChart').getContext('2d');
        var orderTrendsByProductChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    @foreach ($orderTrendsByProduct as $item)
                        '{{ $item->product->title }} ({{ $item->total_orders }})',
                    @endforeach
                ],
                datasets: [{
                    label: 'Total Orders',
                    data: [
                        @foreach ($orderTrendsByProduct as $item)
                            {{ $item->total_orders }},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },

        });
    </script>
    {{-- Order Trends by Product --}}

    </html>
</x-app-layout>
