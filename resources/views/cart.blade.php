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
                @foreach($cart['items'] as $product)
                <li>
                    <span class="title">
                        <a href="{{ route('product_details', $product['slug']) }}">
                            {{ $product['title'] }}
                        </a>
                    </span>

                    <span class="price">
                        <span class="currency">Ksh. </span>
                        <span class="price_amount">{{ $product['price'] }}</span>
                    </span>

                    <span class="product_quantity">
                        <form action="{{ route('change_quantity', $product['id']) }}" method="post">
                            @csrf
                            <input type="number" name="quantity" id="quantity" min="1" value="{{ $product['quantity'] }}">
                            <button type="submit">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </form>
                    </span>

                    <span class="subtotal">
                        <span class="currency">Ksh. </span>
                        <span class="subtotal_amount">{{ $product['quantity'] * $product['price'] }}</span>
                    </span>

                    <span class="delete_from_cart">
                        <form id="deleteForm_{{ $product['id'] }}" action="{{ route('delete_from_cart', $product['id']) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="button" onclick="deleteItem({{ $product['id'] }}, 'product');">
                                <i class="fas fa-trash text-danger"></i>
                            </button>
                        </form>
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
                    <a href="{{ route('get_checkout') }}">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
</main>
@include('partials.javascripts')
@endsection
