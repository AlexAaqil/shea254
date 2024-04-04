<x-app-layout>
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
                    @if($product->discount_price != 0.00 && $product->discount_price < $product->selling_price)
                        <span class="price">
                            <span class="amount">Ksh. {{ $product->discount_price }}</span>
                            <span class="discount_price">
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
                </p>

                <div class="action">
                    <form action="{{ route('cart.store', $product->id) }}" method="post">
                        @csrf
                        <button type="submit">
                            <i class="fas fa-cart-plus add_to_cart_btn"></i> Add to Cart
                        </button>
                    </form>
                </div>

                <p class="description">{{ Illuminate\Support\Str::limit($product->description, 150) }}</p>

                <div class="extras">
                    <p>
                        <span>Size</span>
                        <span>{{ $product->product_measurement }}</span>
                    </p>
                    <p>
                        <span>Category</span>
                        @if($product->category_id != null)
                            <a href="{{ route('products.categorized', $product->product_category->slug) }}">
                                <span>{{ $product->product_category->title }}</span>
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

<x-slot name="javascript">
    <script>
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
</x-slot>
</x-app-layout>
