@extends('partials.base')
@section('content')
@include('partials.navbar')
<main class="Shop">
    <section class="Products">
        <div class="container">
            <div class="products_wrapper">
                @foreach($products as $product)
                <div class="product">
                    <div class="image">
                        <a href="">
                            <img src="{{ $product->getFirstImage() }}" alt="Product">
                        </a>
                    </div>
                    <div class="text">
                        <div class="product_details">
                            <div class="extra">
                                <span>{{ $product->category->title }}</span>
                                <span>{{ $product->product_size->product_size }}</span>
                            </div>

                            <div class="info">
                                <p class="title">
                                    <a href="">{{ $product->title }}</a>
                                </p>
                                <p class="price_details">
                                    <span class="currency">Ksh.</span>
                                    <span class="price_amount">{{ $product->price }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="cart">
                            <i class="fas fa-shopping-bag add_to_cart_btn"></i>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
