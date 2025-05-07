<x-app-layout>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @include('homeComponents.header')

    <section class="history" style="padding-top: 150px">
        <div class="container">
            <div class="card text-start">
                <div class="card-body">
                    <h4 class="card-title text-center fs-5" style="color: #CE1A1A;"><b>Your Order History</b></h4>

                    <div class="container p-5">
                        @foreach ($orders as $order)
                            <div class="card text-start mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="card-text ms-3 mt-3" style="color: tomato; font-size: 18px"><b>{{ $order->product->title }}</b></p>
                                        <img class="card-img-top p-3"
                                            src="{{ asset('storage/' . $order->product->image) }}" alt=""
                                            style="width: 250px; height: 220px">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body pt-4 mt-4">
                                            <h5 class="card-title">Order Number: {{ $order->order_number }}</h5>
                                            <p class="card-text">Total Price: ${{ $order->total_price }}</p>
                                            <p class="card-text">Quantity: {{ $order->quantity }}</p>
                                            <p class="card-text">Special Request: {{ $order->special_request }}</p>
                                            <p class="card-text">Paid by: {{ ucfirst($order->payment_method) }}</p>
                                            <p class="card-text">Ordered On:
                                                {{ $order->created_at->format('d M Y, h:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 pt-4 mt-3">
                                        @php
                                            $status = strtolower(trim($order->status));
                                            $statusClass = '';
                                            $statusIcon = '';
                                    
                                            switch ($status) {
                                                case 'approved':
                                                    $statusClass = 'bg-success';
                                                    $statusIcon = '<i class="fa-solid fa-check" style="color: #4be00b;"></i>';
                                                    break;
                                                case 'pending':
                                                    $statusClass = 'bg-secondary';
                                                    $statusIcon = '<i class="fa-solid fa-clock" style="color: #f0be0b;"></i>';
                                                    break;
                                                case 'declined':
                                                    $statusClass = 'bg-danger';
                                                    $statusIcon = '<i class="fa-solid fa-rectangle-xmark" style="color: #ffffff;"></i>';
                                                    break;
                                                case 'User Declined':
                                                    $statusClass = 'bg-danger';
                                                    $statusIcon = '<i class="fa-solid fa-rectangle-xmark" style="color: #ffffff;"></i>';
                                                    break;
                                                default:
                                                    $statusClass = 'bg-secondary';
                                                    $statusIcon = '<i class="bi bi-question-circle me-2"></i>';
                                                    break;
                                            }
                                        @endphp
                                    
                                        <p class="card-text text-white {{ $statusClass }}" style="padding: 10px 20px; border-radius: 5px; display: inline-block; text-align: center;">
                                            {!! $statusIcon !!} {{ ucfirst($order->status) }}
                                        </p>

                                        <div style="margin-top: 100px">
                                            @if($status === 'pending')
                                                <form action="{{ route('orders.decline', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-danger">Cancel Order</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('homeComponents.footer')
</x-app-layout>
