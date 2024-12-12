<x-app-layout>
    <html lang="en">

    <head>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/cart.css') }}" rel="stylesheet">

    </head>

    <body>
        <div>
            @include('HomeComponents.header')
            @include('HomeComponents.hero')
            
            <main class="container" id="main">
                @include('HomeComponents.menu')
                @include('HomeComponents.about')
                @include('HomeComponents.contact')
            </main>
    
            @include('HomeComponents.footer')
        </div>

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
