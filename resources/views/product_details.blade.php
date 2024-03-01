@extends('partials.base')
@section('content')
@include('partials.navbar')
<main class="Product_details">
    @include('partials.messages')
    <div class="container">
        <div class="wrapper">
            <div class="images">
                <div class="main_product_image">
                    <img src="{{ $product->getFirstImage() }}" alt="{{ $product->title }}" >
                </div>
                <div class="other_images">
                    @foreach($product_images as $image)
                        <img src={{ $image->getProductImageURL() }} alt="Other Image">
                    @endforeach
                </div>
            </div>

            <div class="details">
                <h1>{{ $product->title }}</h1>
                <p class="price">
                    <span class="currency">Ksh. </span>
                    <span class="price_amount">{{ $product->price }}</span>
                </p>

                <div class="action">
                    <form action="{{ route('add_to_cart', $product->id) }}" method="post">
                        @csrf
                        <button type="submit">
                            <i class="fas fa-shopping-cart add_to_cart_btn"></i> Add to Cart
                        </button>
                    </form>
                </div>

                <p class="description">{{ Illuminate\Support\Str::limit($product->description, 150) }}</p>

                <div class="extras">
                    <p>
                        <span>Size</span>
                        <span>{{ $product->product_size }}</span>
                    </p>
                    <p>
                        <span>Category</span>
                        @if($product->category != null)
                        <a href="{{ route('list_products_by_category', $product->category->slug) }}">
                            <span>{{ $product->category->title }}</span>
                        </a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if($related_products->count() > 0)
    <div class="container related_products">
        <h2>Related Products</h2>
        <div class="products_wrapper">
            @foreach($related_products as $product)
                @include('partials.product')
            @endforeach
        </div>
    </div>
    @endif
</main>
@include('partials.javascripts')
@endsection
