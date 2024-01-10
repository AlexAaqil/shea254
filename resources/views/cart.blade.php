@extends('partials.base')
@section('content')
@include('partials.navbar')
<main class="Cart">
    <div class="container">
        <div class="header">
            <h1>Your Bag</h1>
            <p>You have {{ Session::get('cart_count', 0) }} items in your bag</p>
        </div>

        <div class="body">
            <ul class="list_style_none">
                @foreach($cart['items'] as $productId => $item)
                <li>
                    <span class="title">
                        <a href="{{ route('product_details', $item['slug']) }}">
                            {{ $item['title'] }}
                        </a>
                    </span>

                    <span class="price">
                        <span class="currency">Ksh. </span>
                        <span class="price_amount">{{ $item['price'] }}</span>
                    </span>

                    <span class="quantity">
                        <i class="fas fa-plus increment"></i>
                        <span class="quantity_count">{{ $item['quantity'] }}</span>
                        <i class="fas fa-minus decrement"></i>
                    </span>

                    <span class="subtotal">
                        <span class="currency">Ksh. </span>
                        <span class="subtotal_amount">{{ $item['quantity'] * $item['price'] }}</span>
                    </span>

                    <span>
                        <i class="fas fa-trash text-danger"></i>
                    </span>
                </li>
                @endforeach
            </ul>

            <div class="summary">
                <h1>Order Summary</h1>
                <p>
                    <span>Cart Total</span>
                    <span>Ksh. {{ $cart['subtotal'] }}</span>
                </p>

                <div class="action">
                    <a href="#">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
