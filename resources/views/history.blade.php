<x-app-layout>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="/home" class="logo d-flex align-items-center me-auto me-lg-0">
                <h1>HFood<span>.</span></h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="/home">Home</a></li>
                    <li><a href="/home/#about">About</a></li>
                    <li><a href="/home/#menu">Menu</a></li>
                    <li><a href="/home/#contact">Contact</a></li>
                    <li class="dropdown">
                        <a href=""><span>{{ Auth::user()->name }}</span> <i
                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li>
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                            </li>
                            <li>
                                @auth
                                    @if (auth()->user()->isUser())
                                        <x-dropdown-link :href="route('order.history')">
                                            {{ __('Order History') }}
                                        </x-dropdown-link>
                                    @endif
                                @endauth
                            </li>
                            <li>
                                @auth
                                    @if (auth()->user()->isAdmin())
                                        <x-dropdown-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                            {{ __('Dashboard') }}
                                        </x-dropdown-link>
                                    @endif
                                @endauth
                            </li>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </ul>
                    </li>
                </ul>
                <div class="ms-3" style="cursor: pointer;">
                    <a href="/home/cart"><i class="fa-solid fa-cart-shopping fs-4"></i></a>
                </div>
            </nav><!-- .navbar -->
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        </div>
    </header><!-- End Header -->

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
                                            src="{{ asset('images/' . $order->product->image) }}" alt=""
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
</x-app-layout>
