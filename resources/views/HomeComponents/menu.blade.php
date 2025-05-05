<meta name="cart-add-url" content="{{ route('cart.add') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/cart.js') }}"></script>

<!-- Menu Section -->
<section id="menu" class="menu">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <h2>Our Menu</h2>
            <p>Check Our <span>Delicious Menu</span></p>
        </div>

        <!-- Category Tabs -->
        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#menu-all">
                    <h4 class="text-success pointer">All</h4>
                </a>
            </li>
            @foreach ($categories as $category)
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-{{ $category->id }}">
                        <h4 class="text-danger pointer">{{ $category->name }}</h4>
                    </a>
                </li>
            @endforeach
        </ul>

        <!-- Product Tabs Content -->
        <div class="pt-4 tab-content" data-aos="fade-up" data-aos-delay="300">
            <!-- All Products -->
            <div class="tab-pane fade active show" id="menu-all">
                <div class="row gy-4">
                    @foreach ($products as $product)
                        @include('partials.menu-card', ['product' => $product])
                    @endforeach
                </div>
            </div>

            <!-- Category Products -->
            @foreach ($categories as $category)
                <div class="tab-pane fade" id="menu-{{ $category->id }}">
                    <div class="row gy-4">
                        @forelse ($category->products as $product)
                            @include('partials.menu-card', ['product' => $product, 'categoryPrefix' => $category->id])
                        @empty
                            <div class="col-md-12 pt-5 d-flex justify-content-center">
                                <img class="img-fluid" style="max-width: 500px; height: 300px;" src="https://cdn.iconscout.com/icon/premium/png-256-thumb/no-item-found-4372183-3626865.png?f=webp" alt="NoFound">
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="clearfix pt-5">
            {{ $products->appends(['search' => request('search')])->links() }}
        </div>
    </div>
</section>
