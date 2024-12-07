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
                                                        <h2>Order <b>Management</b></h2>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <a href="{{ route('admin.orders.create') }}"
                                                            class="btn btn-secondary"><i
                                                                class="material-icons">&#xE147;</i> <span>Add</span></a>
                                                        <form method="GET" action="{{ route('orders.index') }}"
                                                            class="d-inline-block">
                                                            <div class="input-group">
                                                                <input type="text" name="search"
                                                                    class="form-control" placeholder="Search ..."
                                                                    value="{{ request('search') }}">
                                                                <div class="input-group-append">
                                                                    <button class="btn"
                                                                        style="background-color: rgb(255, 255, 255)"
                                                                        type="submit">
                                                                        <i class="fa-solid fa-magnifying-glass"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Order No.</th>
                                                        <th>Image</th>
                                                        <th>Remark</th>
                                                        <th>Food</th>
                                                        <th>Total</th>
                                                        <th>Quantity</th>
                                                        <th>Customer</th>
                                                        <th>Paid</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders as $order)
                                                        <tr onclick="window.location.href='{{ route('orders.show', $order->id) }}'" style="cursor: pointer;">
                                                            <td>{{ $order->order_number }}</td>
                                                            <td><img src="{{ asset('images/' . $order->product->image) }}"
                                                                    alt="" style="width: 120px; height: 80px;">
                                                            </td>
                                                            <td>{{ $order->special_request }}</td>
                                                            <td>{{ $order->product->title }}</td>
                                                            <td>${{ $order->total_price }}</td>
                                                            <td class="text-center">{{ $order->quantity }}</td>
                                                            <td>{{ $order->user->name }}</td>
                                                            <td>{{ $order->payment_method }}</td>
                                                            <td>
                                                                <form action="{{ route('orders.update', $order->id) }}"
                                                                    method="POST" onsubmit="event.stopPropagation();">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <select name="status" class="status-select"
                                                                        onchange="this.form.submit()">
                                                                        <option value="pending" class="text-warning"
                                                                            {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                                            Pending</option>
                                                                        <option value="approved" class="text-success"
                                                                            {{ $order->status == 'approved' ? 'selected' : '' }}>
                                                                            Approved</option>
                                                                        <option value="declined" class="text-danger"
                                                                            {{ $order->status == 'declined' ? 'selected' : '' }}>
                                                                            Declined</option>
                                                                    </select>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="clearfix">
                                                <ul class="paginations">
                                                    {{ $orders->appends(['search' => request('search')])->links() }}
                                                </ul>
                                            </div>
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

        <script>
            document.querySelectorAll('.status-select').forEach(select => {
                select.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });
        </script>

    </body>

    </html>
</x-app-layout>
