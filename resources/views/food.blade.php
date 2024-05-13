<x-app-layout>
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <h1 class="text-center p-5 price" style="font-size: 35px;"><p>Check Our <span>Yummy Menu</span></p></h1>
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-6 mb-4">
                    <section id="menu" class="menu">
                        <div data-aos="fade-up">
                            <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                                <div class="row gy-5 justify-content-center">
                                    <div class="col-lg-12 menu-item">
                                        <a href="assets/img/menu/menu-item-1.png" class="glightbox">
                                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}" class="menu-img">
                                        </a>
                                        <div class="menu-details">
                                            <h4 class="menu-title p-3 price">{{ $product->title }}</h4>
                                            <h5 class="menu-category ms-3" style="color: green;">{{ $product->category->name }}</h5>
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <p class="ingredients mt-3 ms-1 col-4">
                                                        Information: 
                                                    </p>
                                                    <div class="col-7 mt-3 description-container">
                                                        {!! $product->description !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="menu-footer d-flex justify-content-between align-items-center">
                                            <p class="price">
                                             ${{ $product->price }}
                                            </p>
                                            <div>
                                                <a href="#" class="btn btn-primary">Order</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endforeach
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var descriptionContainers = document.querySelectorAll('.description-container');
        descriptionContainers.forEach(function(container) {
            var text = container.textContent;
            var maxHeight = parseInt(window.getComputedStyle(container).maxHeight, 10);
            if (container.scrollHeight > maxHeight) {
                while (container.scrollHeight > maxHeight) {
                    text = text.slice(0, -1);
                    container.innerHTML = text + '...';
                }
            }
        });
    });
</script>

</x-app-layout>
