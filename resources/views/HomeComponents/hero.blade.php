<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
        <div class="row justify-content-between gy-5 px-4">
            <div class="col-lg-5 col-md-12 col-sm-12 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
                <h2 data-aos="fade-up">Enjoy Your <br>Delicious Food</h2>
                <p data-aos="fade-up" data-aos-delay="100">Our website helps users find and enjoy delicious food
                    by providing information, recipes, and an ordering system.</p>
                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                    <a href="#menu" class="btn-book-a-table">Explore food</a>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 text-center text-lg-start">
                <div id="latestFoodCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000" data-aos="zoom-out" data-aos-delay="300" style="width: 450px; height: 300px; margin: 0 auto; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
                    <div class="carousel-indicators" style="bottom: -30px; margin-bottom: 0;">
                        @php
                            $latestFoods = App\Models\Product::latest()->take(3)->get();
                        @endphp
                        @foreach ($latestFoods as $index => $food)
                            <button type="button" data-bs-target="#latestFoodCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}" style="width: 12px; height: 12px; border-radius: 50%; background-color: #fff; border: 2px solid #444; opacity: 0.8; transition: all 0.3s ease; {{ $index === 0 ? 'background-color: #444; opacity: 1;' : '' }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner" style="width: 100%; height: 100%;">
                        @foreach ($latestFoods as $index => $food)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" style="width: 100%; height: 100%;">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#carouselProductModal{{ $food->id }}">
                                    <img src="{{ asset('storage/' . $food->image) }}" class="d-block" alt="{{ $food->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px; transition: opacity 0.8s ease-in-out; cursor: pointer;">
                                </a>
                                <div class="carousel-caption d-block" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)); padding: 10px; border-radius: 0 0 20px 20px; bottom: 0; left: 0; right: 0; transition: all 0.3s ease;">
                                    <h5 class="text-white mb-0" style="font-size: 1.1rem; font-weight: 500; text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);">{{ $food->title }}</h5>
                                </div>
                            </div>
                        @endforeach
                        @if ($latestFoods->isEmpty())
                            <div class="carousel-item active" style="width: 100%; height: 100%;">
                                <img src="https://via.placeholder.com/450x300" class="d-block" alt="No new foods" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px; transition: opacity 0.8s ease-in-out;">
                                <div class="carousel-caption d-block" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)); padding: 10px; border-radius: 0 0 20px 20px; bottom: 0; left: 0; right: 0; transition: all 0.3s ease;">
                                    <h5 class="text-white mb-0" style="font-size: 1.1rem; font-weight: 500; text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);">No New Foods Yet</h5>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- Carousel controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#latestFoodCarousel" data-bs-slide="prev" style="width: 15%; opacity: 0.7; transition: opacity 0.3s ease;">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.6); border-radius: 50%; padding: 18px; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#latestFoodCarousel" data-bs-slide="next" style="width: 15%; opacity: 0.7; transition: opacity 0.3s ease;">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.6); border-radius: 50%; padding: 18px; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- text -->
                <p class="text-center mt-2" data-aos="fade-up" data-aos-delay="400" style="font-size: 1.2rem; font-weight: 600; color: #CE1A1A; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">
                    <span class="text-background"><i class="fa-solid fa-exclamation fa-beat"></i>&nbsp; New Added</span>
                  </p>
            </div>
        </div>

        <!-- Modals for Carousel Items -->
        @foreach ($latestFoods as $food)
            <div class="modal fade product-modal" id="carouselProductModal{{ $food->id }}" tabindex="-1" aria-labelledby="carouselProductModalLabel{{ $food->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title price" id="carouselProductModalLabel{{ $food->id }}">{{ $food->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="background-image: url('https://t4.ftcdn.net/jpg/04/80/74/93/360_F_480749365_xVdiG03NscliF6PYEstNQyoS1GRNJXZV.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ asset('storage/' . $food->image) }}" loading="lazy" alt="{{ $food->title }}" class="img-fluid">
                                    </div>
                                    <div class="col-md-6">
                                        <p class="price">${{ $food->price }}</p>
                                        <div class="fs-5 text-warning">Information:</div>
                                        <p>{!! $food->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @auth
                        <div class="modal-footer">
                            <form class="order-form" data-product-id="{{ $food->id }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $food->id }}">
                                <button type="submit" class="button-normal">Order</button>
                            </form>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section><!-- End Hero Section -->