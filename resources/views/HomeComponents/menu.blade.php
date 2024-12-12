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
                                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                                    loading="lazy" alt="{{ $product->title }}" class="menu-img">
                                                        
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
                                                        <button type="submit" class="button-normal">Order</button>
                                                            
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
                                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                                    loading="lazy" alt="{{ $product->title }}" class="img-fluid">
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="price">
                                                        ${{ $product->price }}
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
                                            <button type="submit" class="button-normal">Order</button>
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
                                                            <img src="{{ asset('storage/' . $product->image) }}" 
                                                                loading="lazy" alt="{{ $product->title }}"
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
                                                                        class="button-normal">Order</button>
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
                                                            <img src="{{ asset('storage/' . $product->image) }}" 
                                                                loading="lazy"
                                                                alt="{{ $product->title }}"
                                                                class="img-fluid">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="price">
                                                                ${{ $product->price }}
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
                                                    <button type="submit" class="button-normal">Order</button>              
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
