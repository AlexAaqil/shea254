<x-app-layout>
    @include('partials.navbar')

    <main class="Homepage">
        @include('partials.messages')

        <section class="Hero">
            <div class="categories">
                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='shea-butter') }}">
                        <h1>Raw</h1>
                        <h1>Shea</h1>
                    </a>
                </div>
    
                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='cocoa-butter') }}">
                        <h1>Raw</h1>
                        <h1>Cocoa</h1>
                    </a>
                </div>
    
                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='body-butter') }}">
                        <h1>Body</h1>
                        <h1>Butters</h1>
                    </a>
                </div>
    
                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='essential-oil') }}">
                        <h1>Essential</h1>
                        <h1>Oils</h1>
                    </a>
                </div>
    
                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='carrier-oil') }}">
                        <h1>Carrier</h1>
                        <h1>Oils</h1>
                    </a>
                </div>
    
                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='scrub') }}">
                        <h1>Scrubs</h1>
                    </a>
                </div>
    
                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='serum') }}">
                        <h1>Serums</h1>
                    </a>
                </div>
    
                <div class="category">
                    <a href="{{ route('list_products_by_category', $product='gel') }}">
                        <h1>Gel</h1>
                        <h1>& Others</h1>
                    </a>
                </div>
            </div>
    
            <div class="hero_text">
                <div class="slideshow">
                    <img src="{{ asset('/assets/images/shea254-1.jpg') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-2.png') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-3.png') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-4.png') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-5.png') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-6.jpeg') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-7.jpeg') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-8.jpeg') }}" alt="Hero Image">
                </div>
    
                <div class="brand">
                    <div class="image">
                        <img src="{{ asset('/assets/images/hero-logo.png') }}" alt="Hero Logo">
                    </div>
                    <h1>Shea.254</h1>
                    <p>Skin Care Experts</p>
                </div>
            </div>
        </section>
    
        <section class="Products">
            <div class="container">
                <div class="header">
                    <h1>Most Popular</h1>
                    <a href="{{ route('shop') }}">View all</a>
                </div>
    
                <div class="card_wrapper">
                    @foreach($featured_products as $product)
                    <div class="card product_card">
                        <div class="image">
                            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="title">
                                <img src="{{ $product->getFirstImage() }}" alt="Product">
                            </a>
                        </div>
    
                        <div class="text">
                            <div class="extra_details">
                                @if($product->product_category)
                                    <span>{{ $product->product_category->title }}</span>
                                @endif
                            </div>
                            
                            <div class="content">
                                <div class="details">
                                    <span class="title">
                                        <a href="{{ route('products.edit', ['product' => $product->id]) }}">
                                            {{ $product->title }}
                                        </a>
                                    </span>
                                    <span class="content">
                                        @if($product->discount_price != 0.00 && $product->discount_price < $product->price)
                                            <span class="price">
                                                <span class="currency">Ksh.</span>
                                                <span class="price_amount discount">{{ $product->discount_price }}</span>
                                                <span class="original_price text-danger">
                                                    <del>{{ $product->selling_price }}</del>
                                                </span>
                                                <span class="discount_percentage">
                                                    {{ round($product->calculateDiscount()) }}% off
                                                </span>
                                            </span>
                                        @else
                                            <span class="price">
                                                <span class="currency">Ksh.</span>
                                                <span class="price_amount">{{ $product->selling_price }}</span>
                                            </span>
                                        @endif
                                    </span>
                                </div>
        
                                <div class="actions">
                                    <div class="action">
                                        <form action="" method="POST">
                                            @csrf
        
                                            <button type="submit">
                                                <i class="fa fa-cart-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    @include('partials.footer')

    <x-slot name="javascript">
        <x-jquery>
            <script>
                $(document).ready(function() {
                    var currentSlide = 0;
                    var slides = $('.hero_text .slideshow img');

                    function showSlide(index) {
                        slides.removeClass('active');
                        slides.eq(index).addClass('active');
                    }

                    function nextSlide() {
                        currentSlide = (currentSlide + 1) % slides.length;
                        showSlide(currentSlide);
                    }

                    // Show the first slide initially
                    showSlide(currentSlide);

                    // Set interval to switch slides every 5 seconds
                    setInterval(nextSlide, 5000);
                });
            </script>
        </x-jquery>
    </x-slot>
</x-app-layout>