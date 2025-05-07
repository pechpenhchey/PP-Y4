<x-app-layout>
    <x-bar-layout>
        @section('content')
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
                                            <a href="{{ route('admin.orders.create') }}" class="btn btn-secondary">
                                                <i class="material-icons">&#xE147;</i> <span>Add</span>
                                            </a>
                                            <form method="GET" action="{{ route('orders.index') }}" class="d-inline-block">
                                                <div class="input-group">
                                                    <input type="text" name="search" class="form-control" placeholder="Search ..." value="{{ request('search') }}">
                                                    <div class="input-group-append">
                                                        <button class="btn" style="background-color: rgb(255, 255, 255)" type="submit">
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
                                                <td>
                                                    <img src="{{ asset('storage/' . $order->product->image) }}" class="avatar" alt="" style="width: 120px; height: 80px;" loading="lazy">
                                                </td>
                                                <td>{{ $order->special_request }}</td>
                                                <td>{{ $order->product->title }}</td>
                                                <td>${{ $order->total_price }}</td>
                                                <td class="text-center">{{ $order->quantity }}</td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>{{ $order->payment_method }}</td>
                                                <td>
                                                    @if ($order->status === 'pending')
                                                        <form action="{{ route('orders.update', $order->id) }}" method="POST" onsubmit="event.stopPropagation();">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="status" class="status-select" onchange="this.form.submit()">
                                                                <option value="pending" class="text-warning" selected>Pending</option>
                                                                <option value="approved" class="text-success">Approved</option>
                                                                <option value="declined" class="text-danger">Declined</option>
                                                            </select>
                                                        </form>
                                                    @else
                                                        @if ($order->status === 'approved')
                                                            <span class="badge bg-success" style="font-size: 12px">Approved</span>
                                                        @elseif ($order->status === 'declined')
                                                            <span class="badge bg-danger" style="font-size: 12px">Declined</span>
                                                        @elseif ($order->status === 'User Declined')
                                                            <span class="badge bg-danger" style="font-size: 12px">User Declined</span>
                                                        @endif
                                                    @endif
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

            <script>
                document.querySelectorAll('.status-select').forEach(select => {
                    select.addEventListener('click', function (event) {
                        event.stopPropagation();
                    });
                });
            </script>

        @endsection
    </x-bar-layout>
</x-app-layout>
