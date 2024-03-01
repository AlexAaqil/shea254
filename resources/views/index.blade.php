@extends('partials.base')

@section('content')
@include('partials.navbar')
<main class="Homepage">
    @include('partials.messages')
    <section class="Hero">
        <div class="container_fluid">
            <div class="categories">
                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='shea-butter') }}">
                        <h1>Shea</h1>
                        <h1>Butter</h1>
                    </a>
                </div>

                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='black-soap') }}">
                        <h1>Black</h1>
                        <h1>Soap</h1>
                    </a>
                </div>


                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='cocoa-butter') }}">
                        <h1>Cocoa</h1>
                        <h1>Butter</h1>
                    </a>
                </div>

                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='essential-oil') }}">
                        <h1>Essential</h1>
                        <h1>Oils</h1>
                    </a>
                </div>

                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='carrier-oils') }}">
                        <h1>Carrier</h1>
                        <h1>Oils</h1>
                    </a>
                </div>

                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='body-butters') }}">
                        <h1>Body</h1>
                        <h1>Butters</h1>
                    </a>
                </div>
            </div>

            <div class="hero_text">
                <div class="image">
                    <img src="{{ asset('/assets/images/hero_logo.png') }}" alt="Logo">
                </div>

                <div class="brand">
                    <h1>Shea.254</h1>
                    <p>Skin Care Experts</p>
                </div>

                <div class="banner">
                    <h1>Cosmetics</h1>
                    <h1>Shop</h1>
                </div>

                <div class="footer">
                    <p>We Only Sell</p>
                    <p>100% Natural</p>
                    <p>Skin Care Products</p>
                </div>
            </div>
        </div>
    </section>

    <section class="Products">
        <div class="container">
            <div class="header">
                <h1>Most Popular</h1>
                <a href="{{ route('shop') }}">View all</a>
            </div>

            <div class="products_wrapper">
                @foreach($featured_products as $product)
                @include('partials.product')
                @endforeach
            </div>
        </div>
    </section>
</main>
@include('partials.footer')
@endsection
