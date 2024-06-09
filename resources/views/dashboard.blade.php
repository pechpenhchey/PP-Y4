<x-app-layout>
    <html lang="en">

    <head>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    </head>

    <body>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="container d-flex align-items-center justify-content-between">
                <a href="/home" class="logo d-flex align-items-center me-auto me-lg-0">
                    <h1>HFood<span>.</span></h1>
                </a>

                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a href="#hero">Home</a></li>
                        <li><a href="#menu">Menu</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <div class="ms-3" style="cursor: pointer;">
                            <a href="/home/cart"><i class="fa-solid fa-cart-shopping fs-5"></i></a>
                        </div>
                        
                        {{-- Notification --}}
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw" style="font-size: 20px"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger" style="font-size: 10px; position: absolute; top: -19px; right: 6px;">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Your Orders Notification
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="Ordered products image">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Ordered products title</div>
                                        <div class="small text-gray-500">(Your food is coming(if admin aprrove), Out of stock(if admin desline), Original(pending))</div>
                                    </div>
                                </a>
                            </div>
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

        <!-- ======= Hero Section ======= -->
        <section id="hero" class="hero d-flex align-items-center section-bg">
            <div class="container">
                <div class="row justify-content-between gy-5">
                    <div
                        class="col-lg-5 Add to cart-2 Add to cart-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
                        <h2 data-aos="fade-up">Enjoy Your Healthy<br>Delicious Food</h2>
                        <p data-aos="fade-up" data-aos-delay="100">Sed autem laudantium dolores. Voluptatem itaque ea
                            consequatur eveniet. Eum quas beatae cumque eum quaerat.</p>
                        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                            <a href="#menu" class="btn-book-a-table">Explore food</a>
                        </div>
                    </div>
                    <div class="col-lg-5 Add to cart-1 Add to cart-lg-2 text-center text-lg-start">
                        <img src="https://wallpapers.com/images/featured/food-4k-1pf6px6ryqfjtnyr.jpg" class="img-fluid"
                            alt="" data-aos="zoom-out" data-aos-delay="300">
                    </div>
                </div>
            </div>
        </section><!-- End Hero Section -->

        <main id="main">

            <!-- ======= Menu Section ======= -->
            <section id="menu" class="menu">
                <div class="container" data-aos="fade-up">

                    <div class="section-header">
                        <h2>Our Menu</h2>
                        <p>Check Our <span>Healthy Menu</span></p>
                    </div>
                    {{-- Search --}}
                    <div class="search mb-5">
                        {{-- <form action="{{ route('food.products.search') }}" method="GET">
                            <i class="fa fa-search"></i>
                            <input type="text" name="search" class="form-control" placeholder="Search by title, price, or category">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form> --}}
                    </div>
                    <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#menu-all">
                                <h4 style="color: green; cursor: pointer; font-size: large;">All</h4>
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-{{ $category->id }}">
                                    <h4 style="color: orangered; font-size: large; cursor: pointer;">
                                        {{ $category->name }}</h4>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                        <div class="tab-pane fade active show" id="menu-all">
                            <!-- Display all products -->
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-lg-3 col-md-6">
                                        <section id="menu" class="menu">
                                            <div data-aos="fade-up">
                                                <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                                                    <div class="row gy-5 justify-content-center">
                                                        <div class="col-lg-12 menu-item">
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#productModal{{ $product->id }}"
                                                                class="glightbox">
                                                                <img src="{{ asset('images/' . $product->image) }}"
                                                                    alt="{{ $product->title }}" class="menu-img">
                                                            </a>
                                                            <div class="menu-details">
                                                                <h4 class="menu-title p-3 price">{{ $product->title }}
                                                                </h4>
                                                                <h5 class="menu-category ms-3 mb-3"
                                                                    style="color: green;">
                                                                    {{ $product->category->name ?? 'No Category' }}
                                                                </h5>
                                                            </div>
                                                            <div
                                                                class="menu-footer d-flex justify-content-between align-items-center">
                                                                <p class="price">
                                                                    ${{ $product->price }}
                                                                </p>
                                                                <form action="{{ route('cart.add') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="product_id"
                                                                        value="{{ $product->id }}">
                                                                    <button type="submit" class="btn btn-primary">Add
                                                                        to cart</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>

                                    <!-- Food Modal -->
                                    <div class="modal fade product-modal" id="productModal{{ $product->id }}"
                                        tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title price" id="productModalLabel">
                                                        {{ $product->title }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <img src="{{ asset('images/' . $product->image) }}"
                                                                    alt="{{ $product->title }}" class="img-fluid">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="price">
                                                                    ${{ $product->price }}/each
                                                                </p>
                                                                <div class="fs-5 my-1 text-warning">Information:</div>
                                                                <p>{!! $product->description !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('cart.add') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        <button type="submit" class="btn btn-primary">Add
                                                            to cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @foreach ($categories as $category)
                            <div class="tab-pane fade" id="menu-{{ $category->id }}">
                                <!-- Display products for this category -->
                                <div class="row">
                                    @if ($category->products->isEmpty())
                                        <div class="col-md-12 pt-5 d-flex justify-content-center">
                                            <img class="img-fluid" style="max-width: 500px; height: 300px;"
                                                src="https://cdn.iconscout.com/icon/premium/png-256-thumb/no-item-found-4372183-3626865.png?f=webp"
                                                alt="NoFound">
                                        </div>
                                    @else
                                        @foreach ($category->products as $product)
                                            <div class="col-lg-3 col-md-6 mb-4">
                                                <section id="menu" class="menu">
                                                    <div data-aos="fade-up">
                                                        <div class="tab-content" data-aos="fade-up"
                                                            data-aos-delay="300">
                                                            <div class="row gy-5 justify-content-center">
                                                                <div class="col-lg-12 menu-item">
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#productModal{{ $category->id }}{{ $product->id }}"
                                                                        class="glightbox">
                                                                        <img src="{{ asset('images/' . $product->image) }}"
                                                                            alt="{{ $product->title }}"
                                                                            class="menu-img">
                                                                    </a>
                                                                    <div class="menu-details">
                                                                        <h4 class="menu-title p-3 price">
                                                                            {{ $product->title }}</h4>
                                                                        <h5 class="menu-category ms-3 mb-3"
                                                                            style="color: green;">
                                                                            {{ $product->category->name ?? 'No Category' }}
                                                                        </h5>
                                                                    </div>
                                                                    <div
                                                                        class="menu-footer d-flex justify-content-between align-items-center">
                                                                        <p class="price">
                                                                            ${{ $product->price }}
                                                                        </p>
                                                                        <div>
                                                                            <form action="{{ route('cart.add') }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden"
                                                                                    name="product_id"
                                                                                    value="{{ $product->id }}">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Add
                                                                                    to cart</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>

                                            <!-- Food Modal -->
                                            <div class="modal fade product-modal"
                                                id="productModal{{ $category->id }}{{ $product->id }}"
                                                tabindex="-1" aria-labelledby="productModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title price" id="productModalLabel">
                                                                {{ $product->title }}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <img src="{{ asset('images/' . $product->image) }}"
                                                                            alt="{{ $product->title }}"
                                                                            class="img-fluid">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="price">
                                                                            ${{ $product->price }}/each
                                                                        </p>
                                                                        <div class="fs-5 my-1 text-warning">
                                                                            Information:</div>
                                                                        <p>{!! $product->description !!}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('cart.add') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $product->id }}">
                                                                <button type="submit" class="btn btn-primary">Add
                                                                    to cart</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="clearfix">
                        <ul class="paginations">
                            {{ $products->appends(['search' => request('search')])->links() }}
                        </ul>
                    </div>
                </div>
            </section><!-- End Menu Section -->

            <!-- ======= About Section ======= -->
            <section id="about" class="about">
                <div class="container" data-aos="fade-up">

                    <div class="section-header">
                        <h2>About Us</h2>
                        <p>Learn More <span>About Us</span></p>
                    </div>

                    <div class="row gy-4">
                        <div class="col-lg-7 position-relative about-img"
                            style="background-image: url(https://wallpapers.com/images/featured/food-4k-1pf6px6ryqfjtnyr.jpg);"
                            data-aos="fade-up" data-aos-delay="150">
                            <div class="call-us position-absolute">
                                <h4>Book a Table</h4>
                                <p>+1 5589 55488 55</p>
                            </div>
                        </div>
                        <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
                            <div class="content ps-0 ps-lg-5">
                                <p class="fst-italic">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore
                                    magna aliqua.
                                </p>
                                <ul>
                                    <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat.</li>
                                    <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in
                                        voluptate velit.</li>
                                    <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate trideta
                                        storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                                </ul>
                                <p>
                                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                    reprehenderit in voluptate
                                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                    non proident
                                </p>

                                <div class="position-relative mt-4">
                                    <img src="https://wallpapers.com/images/featured/food-4k-1pf6px6ryqfjtnyr.jpg"
                                        class="img-fluid" alt="">
                                    <a href="https://www.youtube.com/" class="glightbox play-btn"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section><!-- End About Section -->

            <!-- ======= Contact Section ======= -->
            <section id="contact" class="contact">
                <div class="container" data-aos="fade-up">

                    <div class="section-header">
                        <h2>Contact</h2>
                        <p>Need Help? <span>Contact Us</span></p>
                    </div>

                    <div class="mb-3">
                        <iframe style="bAdd to cart:0; width: 100%; height: 350px;"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.773035617568!2d104.88924327693495!3d11.568121794920096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109519fe4077d69%3A0x20138e822e434660!2sRoyal%20University%20of%20Phnom%20Penh!5e0!3m2!1sen!2skh!4v1717785996720!5m2!1sen!2skh"
                            framebAdd to cart="0" allowfullscreen></iframe>
                    </div><!-- End Google Maps -->

                    <div class="row gy-4">

                        <div class="col-md-6">
                            <div class="info-item  d-flex align-items-center">
                                <i class="icon fa-solid fa-location-dot flex-shrink-0"></i>
                                <div>
                                    <h3>Our Address</h3>
                                    <p>Rupp</p>
                                </div>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item d-flex align-items-center">
                                <i class="icon fa-solid fa-envelope flex-shrink-0"></i>
                                <div>
                                    <h3>Email Us</h3>
                                    <p>contact@gmail.com</p>
                                </div>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item  d-flex align-items-center">
                                <i class="icon fa-solid fa-phone flex-shrink-0"></i>
                                <div>
                                    <h3>Call Us</h3>
                                    <p>+855 12345678</p>
                                </div>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item  d-flex align-items-center">
                                <i class="icon fa-solid fa-clock flex-shrink-0"></i>
                                <div>
                                    <h3>Opening Hours</h3>
                                    <div><strong>Mon-Sat:</strong> 9AM - 22PM;
                                        <strong>Sunday:</strong> Closed
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Info Item -->

                    </div>
                </div>
            </section><!-- End Contact Section -->

        </main><!-- End #main -->

        <!-- ======= Footer ======= -->
        <footer id="footer" class="footer">

            <div class="container">
                <div class="row gy-3 d-flex justify-content-center">
                    <div class="col-lg-3 col-md-6 d-flex">
                        <i class="bi bi-geo-alt icon"></i>
                        <div>
                            <h4>Address</h4>
                            <p>
                                ITE Y3<br>
                                RUPP<br>
                            </p>
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6 footer-links d-flex">
                        <i class="bi bi-clock icon"></i>
                        <div>
                            <h4>Opening Hours</h4>
                            <p>
                                <strong>Mon-Sat: 9AM</strong> - 22PM<br>
                                Sunday: Closed
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Follow Us</h4>
                        <div class="social-links d-flex">
                            <a href="#" class="twitter"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#" class="facebook"><i class="fa-brands fa-x"></i></a>
                            <a href="#" class="instagram"><i class="fa-brands fa-telegram"></i></a>
                            <a href="#" class="linkedin"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>HFood</span></strong>. All Rights Reserved
                </div>
            </div>

        </footer>

        <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

    </body>

    </html>
</x-app-layout>
