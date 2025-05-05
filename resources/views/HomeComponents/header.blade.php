<link href="{{ asset('css/cart.css') }}" rel="stylesheet">

<style>
    .login-btn:hover {
        background-color: white;
        color: #CE1A1A;
    }
</style>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between px-5">
        <a href="/home" class="d-flex align-items-center">
            <img src="{{ asset('images/logonobg.png') }}" alt="Logo" class="rounded-circle" style="width: 100px; height: 80px;">
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="/home#hero">Home</a></li>
                <li><a href="/home#menu">Menu</a></li>
                <li><a href="/home#about">About</a></li>
                <li class="me-3"><a href="/home#contact">Contact</a></li>

                @guest 
                <!-- visible only to guests --> 
                <div> 
                    <h2> 
                        <a href="{{ route('login') }}" class="btn login-btn" style="background-color: #CE1A1A; color: white; padding: 6px 12px; font-size: 16px; border-radius: 5px; text-align: center; text-decoration: none;">
                            Login
                        </a>
                    </h2> 
                </div>                 
                @endguest
                
                @auth
                <div class="cart-container">
                    <a href="/home/cart"><i class="fa-solid fa-cart-shopping fs-4"></i></a>
                    <span class="badge" id="cart-count">
                        @if (isset($totalCount) && $totalCount > 0)
                            {{ $totalCount }}
                        @else
                            0
                        @endif
                    </span>
                </div>

                <li class="dropdown"><a href=""><span>{{ Auth::user()->name }}</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                        <li>
                            @auth
                                @if (auth()->user()->isUser())
                                    <x-dropdown-link :href="route('order.history')" :active="request()->routeIs('order.history')">
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
                    </li>
                @endauth
            </ul>
        </nav><!-- .navbar -->
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
</header><!-- End Header -->