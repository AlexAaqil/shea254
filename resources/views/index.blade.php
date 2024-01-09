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
                @foreach($featured_products as $product)
                @include('partials.product')
                @endforeach
            </div>
        </div>
    </section>

    {{-- <section class="Products">
        <div class="container">
            <div class="header">
                <h1>Wholesale</h1>
                <a href="">View all</a>
            </div>
        </div>
    </section> --}}
</main>
@include('partials.footer')
@endsection
