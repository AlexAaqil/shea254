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
@section('additional_javascript')
<script>
// Product Details Images Slideshow

document.addEventListener("DOMContentLoaded", function () {
    const mainProductImage = document.querySelector(".main_product_image img");
    const otherImagesContainer = document.querySelector(".other_images");

    otherImagesContainer.querySelectorAll("img").forEach((thumbnail) => {
        thumbnail.addEventListener("click", (event) => {
            // Remove active class from all thumbnails
            otherImagesContainer.querySelectorAll("img").forEach((img) => {
                img.classList.remove("active");
            });

            // Add active class to the clicked thumbnail
            event.target.classList.add("active");

            // Change the source of the main product image with a zoom effect
            mainProductImage.src = event.target.src;
        });
    });

    // Add the zoom effect on hover for the main product image
    mainProductImage.addEventListener("mousemove", (e) => {
        const containerWidth = mainProductImage.offsetWidth;
        const containerHeight = mainProductImage.offsetHeight;

        const image = mainProductImage;
        const imageWidth = image.offsetWidth;
        const imageHeight = image.offsetHeight;

        const x = e.pageX - mainProductImage.offsetLeft;
        const y = e.pageY - mainProductImage.offsetTop;

        const translateX = (containerWidth / 2 - x) * 2;
        const translateY = (containerHeight / 2 - y) * 2;

        const scale = 3;

        image.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scale})`;
    });

    mainProductImage.addEventListener("mouseleave", () => {
        mainProductImage.style.transform = "translate(0%, 0%) scale(1)";
    });
});
</script>
@endsection
@endsection
