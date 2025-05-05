<div class="col-lg-3 col-md-6">
    <div class="menu-item">
        <a href="#" data-bs-toggle="modal" data-bs-target="#productModal{{ $categoryPrefix ?? '' }}{{ $product->id }}" class="glightbox">
            <img src="{{ asset('storage/' . $product->image) }}" loading="lazy" alt="{{ $product->title }}" class="menu-img">
        </a>
        <div class="menu-details">
            <h4 class="menu-title p-3 price">{{ $product->title }}</h4>
            <h5 class="menu-category ms-3 mb-3 text-success">
                {{ $product->category->name ?? 'No Category' }}
            </h5>
        </div>
        <div class="menu-footer">
            <p class="price">${{ $product->price }}</p>
            @auth
                <form class="order-form" data-product-id="{{ $product->id }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="button-normal">Order</button>
                </form>
            @endauth
        </div>
    </div>

    <!-- Product Modal -->
    <div class="modal fade product-modal" id="productModal{{ $categoryPrefix ?? '' }}{{ $product->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title price">{{ $product->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $product->image) }}" loading="lazy" alt="{{ $product->title }}" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <p class="price">${{ $product->price }}</p>
                            <div class="fs-5 my-1 text-warning">Information:</div>
                            <p>{!! $product->description !!}</p>
                        </div>
                    </div>
                </div>
                @auth
                    <div class="modal-footer">
                        <form class="order-form" data-product-id="{{ $product->id }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="button-normal">Order</button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
