<x-app-layout>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @include('homeComponents.header')

    <!-- Add to cart -->
    <div class="cart_section" style="padding-top: 130px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">Your Cart<small> ({{ $totalCount }}) </small></div>

                        @if ($cartItems->isEmpty())
                            <p class="p-3 fs-5">Your cart is empty</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td><img src="{{ asset('storage/' . $item->product->image) }}" 
                                                loading="lazy" alt="" class="cart_item_image"></td>
                                            <td>{{ $item->product->title }}</td>
                                            <td>
                                                <form id="updateForm-{{ $item->id }}" action="{{ route('cart.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" oninput="submitForm({{ $item->id }})">
                                                </form>
                                            </td>
                                            <td>${{ $item->product->price }}</td>
                                            <td>${{ $item->product->price * $item->quantity }}</td>
                                            <td>
                                                <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete" title="Delete" data-toggle="tooltip">
                                                        <i class="fa-solid fa-trash fa-xl" style="color: #ce1212;"></i>
                                                    </button>
                                                </form>
                                            </td>                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Total amount and buttons -->
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount">
                                    ${{ $orderTotal }}
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <form method="POST" action="{{ route('checkout') }}">
                                @csrf
                                @foreach ($cartItems as $item)
                                    <input type="hidden" name="items[{{ $item->product->id }}][product_id]" value="{{ $item->product->id }}">
                                    <input type="hidden" name="items[{{ $item->product->id }}][quantity]" value="{{ $item->quantity }}">
                                    <input type="hidden" name="items[{{ $item->product->id }}][special_request]" value="{{ $item->special_request }}">
                                    <input type="hidden" name="items[{{ $item->product->id }}][total_price]" value="{{ $item->product->price * $item->quantity }}">
                                @endforeach
                                <div class="payment_options">
                                    <h4 class="pb-3 pt-4">Payment Method:</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="pay_cash" value="cash" checked>
                                        <label class="form-check-label" for="pay_cash">Cash</label>
                                    </div>
                                    {{-- <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="pay_other" value="KHQR">
                                        <label class="form-check-label" for="pay_other">Card</label>
                                    </div> --}}
                                </div>
                                <div class="message_box py-3">
                                    <h2 class="pb-3 fs-5">Special Request (if any):</h2>
                                    <textarea name="special_request" id="special_request" rows="3" class="form-control"></textarea>
                                </div>
                                <div class="cart_buttons">
                                    <button type="button" class="button cart_button_clear"><a class="text-black" href="/home/#menu">Continue Shopping</a></button>
                                    <button type="submit" class="button cart_button_checkout">Check out</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('homeComponents.footer')

    <script>
        function submitForm(itemId) {
            document.getElementById('updateForm-' + itemId).submit();
        }

    </script>

</x-app-layout>

