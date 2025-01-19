<x-app-layout>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @include('homeComponents.header')

    <section class="history" style="padding-top: 150px">
        <div class="container">
            <div class="card text-start">
                <div class="card-body">
                    <h4 class="card-title text-center"><b>Your Order History</b></h4>
                    <div class="container p-5">
                        @foreach ($orders as $order)
                            <div class="card text-start mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="card-text ms-3 mt-3" style="color: tomato; font-size: 15px"><b>{{ $order->product->title }}</b></p>
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
                                            <p class="card-text">Paid by: {{ ucfirst($order->payment_method) }}
                                            </p>
                                            <p class="card-text">Ordered On:
                                                {{ $order->created_at->format('d M Y, h:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 pt-4 mt-3">
                                        <p class="card-text" style="background-color: #3cb048; color: #fff; padding: 10px 20px; border-radius: 5px; display: inline-block; text-align: center; transition: background-color 0.3s;">{{ ucfirst($order->status) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Pagination Links -->
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
