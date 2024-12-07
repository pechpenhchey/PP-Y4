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
                            <h1 class="h3 mb-0 text-gray-800">Revenue</h1>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back</a>
                        </div>
                        <!-- Results Row -->
                        <div class="row mt-4">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Total Income</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    @isset($totalAmount)
                                                        {{ $totalAmount }}
                                                    @else
                                                        Please select a date
                                                    @endisset
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Income</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    @isset($income)
                                                        {{ $income }}
                                                    @else
                                                        Please select a date
                                                    @endisset
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-coins fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                    Outcome</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    @isset($outcome)
                                                        {{ $outcome }}
                                                    @else
                                                        Please select a date
                                                    @endisset
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <!-- Content Row -->
                        <div class="row">
                            <!-- Revenue Form -->
                            <div class="col-md-6">
                                <form action="{{ route('admin.revenue.calculate') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" id="start_date" name="start_date" class="form-control" required value="{{ old('start_date', $startDate) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control" required value="{{ old('end_date', $endDate) }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Check</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of Main Content -->
                </div>
                <!-- End of Content Wrapper -->
            </div>
            <!-- End of Page Wrapper -->
    </body>
</x-app-layout>
