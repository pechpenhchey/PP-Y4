<x-app-layout>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <body id="page-top">
        <div id="wrapper">
            @include('admin.sidebar')

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    @include('admin.topbar')

                    <div class="container-fluid">
                        <div class="col">
                            <div class="py-12">
                                <div class="container contact-form">
                                    <hr />
                                    @if (session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('admin.orders.create') }}" method="GET" id="order-form">
                                        @csrf
                                        <span class="fs-5">Add Order</span>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="user_id">User</label>
                                                    <select name="user_id" id="user_id" class="form-control" onchange="this.form.submit()">
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}" {{ request()->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="product_id">Product</label>
                                                <select name="product_id" id="product_id" class="form-control" onchange="this.form.submit()">
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}" {{ request()->product_id == $product->id ? 'selected' : '' }}>{{ $product->title }}, ${{ $product->price }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity">Quantity</label>
                                                <input type="number" name="quantity" id="quantity" class="form-control" required min="1" value="{{ request()->quantity }}" onchange="this.form.submit()">
                                            </div>
                                            <div class="form-group">
                                                <label for="total_price">Total Price</label>
                                                $<input type="number" name="total_price" id="total_price" class="form-control" step="0.01" readonly value="{{ number_format($totalPrice, 2) }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="payment_method">Payment Method</label>
                                                <select name="payment_method" id="payment_method" class="form-control">
                                                    <option value="KHQR" {{ request()->payment_method == 'KHQR' ? 'selected' : '' }}>KHQR</option>
                                                    <option value="cash" {{ request()->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="{{ route('admin.orders.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ request()->user_id }}">
                                        <input type="hidden" name="product_id" value="{{ request()->product_id }}">
                                        <input type="hidden" name="quantity" value="{{ request()->quantity }}">
                                        <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                                        <input type="hidden" name="payment_method" value="{{ request()->payment_method }}">
                                        <div class="form-group">
                                            <label for="special_request">Special Request</label>
                                            <textarea name="special_request" id="special_request" class="form-control">{{ old('special_request') }}</textarea>
                                        </div>
                                        <div class="row d-flex">
                                            <div class="col-lg-1 col-md-3" style="width: 100px">
                                                <button type="submit" class="btn btn-primary">Create</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-lg-1 col-md-3" style="width: 100px; margin-top: -38px; margin-left: 80px;">
                                        <button class="btn btn-danger">
                                            <a class="text-decoration-none text-white" href="{{ route('orders.index') }}">Cancel</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>
