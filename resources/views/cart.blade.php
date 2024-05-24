<x-app-layout>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">

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
                    <li class="dropdown"><a href=""><span>{{ Auth::user()->name }}</span> <i
                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                            <li>
                                @auth
                                    @if (auth()->user()->isUser())
                                        <x-dropdown-link>
                                            {{ __('Add to cart History') }}
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
                    </li>
                </ul>
                </li>
                </ul>
                <div class="ms-3" style="cursor: pointer;">
                    <a href="/cart"><i class="fa-solid fa-cart-shopping fs-4"></i></a>
                </div>

            </nav><!-- .navbar -->
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->

    <!-- Add to cart -->
    <div class="cart_section" style="padding-top: 130px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">Your Cart<small> (item in your cart) </small></div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($cartItems->isEmpty())
                            <p class="p-3 fs-5">Your cart is empty</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td><img src="{{ asset('images/' . $item->product->image) }}" alt=""
                                                    class="cart_item_image"></td>
                                            <td>{{ $item->product->title }}</td>
                                            <td>
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                        min="1">
                                                    <button class="btn btn-primary" type="submit">Update</button>
                                                </form>
                                            </td>
                                            <td>${{ $item->product->price }}</td>
                                            <td>${{ $item->product->price * $item->quantity }}</td>
                                            <td>
                                                <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Total amount and buttons -->
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount">
                                    ${{ $cartItems->sum(function ($item) {
                                        return $item->product->price * $item->quantity;
                                    }) }}
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <form method="POST" action="{{ route('checkout') }}">
                                @csrf
                                @foreach ($cartItems as $item)
                                    <input type="hidden" name="items[{{ $item->product->id }}][product_id]"
                                        value="{{ $item->product->id }}">
                                    <input type="hidden" name="items[{{ $item->product->id }}][quantity]"
                                        value="{{ $item->quantity }}">
                                    <input type="hidden" name="items[{{ $item->product->id }}][special_request]"
                                        value="{{ $item->special_request }}">
                                    <input type="hidden" name="items[{{ $item->product->id }}][total_price]"
                                        value="{{ $item->product->price * $item->quantity }}">
                                @endforeach
                                <div class="payment_options">
                                    <h4 class="pb-3 pt-4">Payment Method:</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="pay_cash" value="cash" checked>
                                        <label class="form-check-label" for="pay_cash">
                                            Pay by Cash
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="pay_other" value="KHQR">
                                        <label class="form-check-label" for="pay_other">
                                            Pay by Card
                                        </label>
                                    </div>
                                </div>
                                <div class="message_box py-3">
                                    <h2 class="pb-3 fs-5">Special Request (if any):</h2>
                                    <textarea name="special_request" id="special_request" rows="3" class="form-control"></textarea>
                                </div>
                                <div class="cart_buttons">
                                    <button type="button" class="button cart_button_clear"><a class="text-black"
                                        href="/home/#menu">Continue Shopping</a></button>
                                    <button type="submit" class="button cart_button_checkout">Check out</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
