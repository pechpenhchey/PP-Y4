<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between px-5">
        <a href="/home" class="logo d-flex align-items-center me-auto me-lg-0">
            <h1>HFood<span>.</span></h1>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="#hero">Home</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <div class="cart-container ms-3">
                    <a href="/home/cart"><i class="fa-solid fa-cart-shopping fs-4"></i></a>
                    @if (isset($totalCount) && $totalCount > 0)
                        <span class="badge">{{ $totalCount }}</span>
                    @endif
                </div>

                <li class="dropdown"><a href=""><span>{{ Auth::user()->name }}</span> <i
                            class="bi bi-chevron-down dropdown-indicator"></i></a>
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
            </ul>
            </li>
            </ul>

        </nav><!-- .navbar -->
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
</header><!-- End Header -->