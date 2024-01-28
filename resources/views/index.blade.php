@extends('partials.base')

@section('content')
@include('partials.navbar')
<main class="Homepage">
    @include('partials.messages')
    <section class="Hero">
        <div class="container">
            <div class="text">
                <img src="{{ asset('/assets/images/hero_logo.png') }}" alt="Logo">
                <h1>Shea254</h1>
                <div class="hero_btns">
                    <a href="{{ route('shop') }}">Retail</a>
                    <a href="{{ route('shop') }}">Wholesale</a>
                </div>
            </div>

            <div class="hero_images">
                <img src="{{ asset('assets/images/hero/hero1.png') }}" alt="Hero" class="hero-image visible">
                <img src="{{ asset('assets/images/hero/hero2.png') }}" alt="Hero" class="hero-image">
                <img src="{{ asset('assets/images/hero/hero3.png') }}" alt="Hero" class="hero-image">
                <img src="{{ asset('assets/images/hero/hero4.png') }}" alt="Hero" class="hero-image">
                <img src="{{ asset('assets/images/hero/hero5.png') }}" alt="Hero" class="hero-image">
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
@section('additional_javascript')
<script>
            document.addEventListener("DOMContentLoaded", function () {
                let currentIndex = 0;
                const images = document.querySelectorAll('.hero_images img');
                const totalImages = images.length;

                function showImage(index) {
                    images.forEach((image, i) => {
                        if (i === index) {
                            image.classList.add('visible');
                        } else {
                            image.classList.remove('visible');
                        }
                    });
                }

                function nextImage() {
                    currentIndex = (currentIndex + 1) % totalImages;
                    showImage(currentIndex);
                }

                // Automatically change the image every 5 seconds
                setInterval(nextImage, 5000);

                // Initial display
                showImage(currentIndex);
            });
        </script>
@endsection
@endsection
