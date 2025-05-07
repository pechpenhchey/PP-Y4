<x-app-layout>
    <html lang="en">

    <head>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        
    </head>

    <body>
        <div>
            @include('homeComponents.header')
            @include('homeComponents.hero')
            
            <main class="container" id="main">
                @include('homeComponents.menu', ['categories' => $categories, 'products' => $products])
                @include('homeComponents.about')
                @include('homeComponents.contact')
            </main>
    
            @include('homeComponents.footer')
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
