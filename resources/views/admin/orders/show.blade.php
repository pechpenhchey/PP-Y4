<x-app-layout>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">

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
                        <!-- Content Row -->
                        <div class="col">
                            <div class="py-12">
                                <div class="container-xl">
                                    <div class="table-responsive">
                                        <div class="table-wrapper">
                                            <div class="table-title">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h2>Order <b>Details</b></h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <section class="vh-100 gradient-custom-2">
                                                <div class="container h-100">
                                                    <div
                                                        class="row d-flex justify-content-center align-items-center pt-3">
                                                        <div class="col-md-10 col-lg-8 col-xl-6">
                                                            <div class="card card-stepper" style="border-radius: 16px;">
                                                                <div class="card-header">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                            <p class="text-muted mb-2"> Order ID <span
                                                                                    class="fw-bold text-body">{{ $order->order_number }}</span>
                                                                            </p>
                                                                            <p class="text-muted mb-0"> Place On <span
                                                                                    class="fw-bold text-body"
                                                                                    id="created_at"
                                                                                    data-iso="{{ $order->created_at->toIso8601String() }}">
                                                                                    {{ $order->created_at->toIso8601String() }}</span>
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="mb-0"> <button
                                                                                    class="btn btn-primary">
                                                                                    <a class="text-decoration-none text-white"
                                                                                        href="{{ route('orders.index') }}">Back</a>
                                                                                </button> </h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="d-flex flex-row mb-4 pb-2">
                                                                        <div class="flex-fill">
                                                                            <h5 class="bold">
                                                                                {{ $order->product->title }}
                                                                            </h5>
                                                                            <p>By: {{ $order->user->name }}</p>
                                                                            <p class="text-muted"> Qt:
                                                                                {{ $order->quantity }} item</p>
                                                                            <h4 class="mb-3"> $ {{ $order->quantity }}
                                                                                <span class="small text-muted">
                                                                                </span></h4>
                                                                            <p class="text-muted">Status:
                                                                                <span class="{{ $order->status == 'approved' ? 'text-success' : ($order->status == 'declined' ? 'text-danger' : 'text-warning') }}"><b>{{ ucfirst($order->status) }}</b></span>
                                                                            </p>
                                                                            <p>
                                                                                Remark: {{ $order->special_request }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <img class="align-self-center img-fluid"
                                                                                src={{ asset('images/' . $order->product->image) }}
                                                                                width="250">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <p>Payment: {{ $order->payment_method }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Main Content -->
                    </div>
                    <!-- End of Content Wrapper -->

                </div>
                <!-- End of Page Wrapper -->

            </div>

    </body>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            function formatToLocalTime(isoString) {
                let date = new Date(isoString);
                return date.toLocaleString();
            }

            let createdAtElement = document.getElementById('created_at');
            let createdAtIso = createdAtElement.getAttribute('data-iso');

            createdAtElement.innerText = formatToLocalTime(createdAtIso);
        });
    </script>

    </html>
</x-app-layout>
