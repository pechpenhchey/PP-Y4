<x-app-layout>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">

    <body id="page-top">
    
        <!-- Page Wrapper -->
        <div id="wrapper">
    
            <!-- Sidebar -->
            @include('admin.sidebar')
            <!-- End of Sidebar -->
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
    
                <!-- Main Content -->
                <div id="content">
    
                    <!-- Topbar -->
                    @include('admin.topbar')
                    <!-- End of Topbar -->
    
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Content Row -->
                        <div class="col">
                <div class="py-12">
                    <div class="container-xl">
                        <div class="table-responsive">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <h2>Order <b>Management</b></h2>
                                        </div>
                                        
                                    </div>                                   
                                </div>
                                <div class="container">
                                    <h1>Order #{{ $order->order_number }}</h1>
                                    <p>Product: {{ $order->product_name }}</p>
                                    <p>Total Price: ${{ $order->total_price }}</p>
                                    <p>Quantity: {{ $order->quantity }}</p>
                                    <p>Status: {{ $order->status }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->
    
        </div>
        <!-- End of Page Wrapper -->
    
    </body>
    
    </html>
</x-app-layout>
    