@extends('partials.base')

@section('content')
@include('partials.navbar')
<main class="Homepage">
    <section class="Hero">
        <div class="container">
            <div class="text">
                <img src="{{ asset('/assets/images/hero_logo.png') }}" alt="Logo">
                <h1>Shea254</h1>
                <div class="hero_btn">
                    <a href="#">Retail Shopping</a>
                </div>
                <div class="hero_btn">
                    <a href="#">Wholesale Shopping</a>
                </div>
            </div>

            <div class="image">
                <img src="{{ asset('assets/images/hero.jpg') }}" alt="Hero">
            </div>
        </div>
    </section>

    <section class="Products">
        <div class="container">
            <div class="header">
                <h1>Most Popular</h1>
                <a href="">View all</a>
            </div>

            <div class="products_wrapper">
                <div class="product">
                    <div class="image">
                        <a href="">
                            <img src="{{ asset('/assets/images/hero.jpg') }}" alt="Product">
                        </a>
                    </div>
                    <div class="text">
                        <div class="product_details">
                            <div class="extra">
                                <span>Essential Oils</span>
                                <span>1 Liter</span>
                            </div>

                            <div class="info">
                                <p class="title">
                                    <a href="">Title</a>
                                </p>
                                <p class="price_details">
                                    <span class="currency">Ksh.</span>
                                    <span class="price_amount">150.00</span>
                                </p>
                            </div>
                        </div>

                        <div class="cart">
                            <i class="fas fa-shopping-bag add_to_cart_btn"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="Products">
        <div class="container">
            <div class="header">
                <h1>Wholesale</h1>
                <a href="">View all</a>
            </div>
        </div>
    </section>
</main>
@include('partials.footer')
@endsection
