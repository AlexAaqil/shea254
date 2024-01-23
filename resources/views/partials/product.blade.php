<div class="product">
    <div class="image">
        <a href="{{ route('product_details', $product->slug) }}">
            <img src="{{ $product->getFirstImage() }}" alt="Product">
        </a>
    </div>
    <div class="text">
        <div class="product_details">
            <div class="extra">
                <a href="{{ route('list_products_by_category', $product->category->slug) }}">
                    <span>{{ $product->category->title }}</span>
                </a>
                <span>{{ $product->product_size->product_size }}</span>
            </div>

            <div class="info">
                <p class="title">
                    <a href="{{ route('product_details', $product->slug) }}">
                        {{ $product->title }}
                    </a>
                </p>
                <p class="price_details">
                    @if($product->discount_price && $product->discount_price < $product->price)
                        <span class="currency">Ksh.</span>
                        <span class="price_amount discount">{{ $product->discount_price }}</span>
                        <span class="original_price text-danger">
                            <del>{{ $product->price }}</del>
                        </span>
                        <span class="discount_percentage">
                            save {{ round($product->discount_percentage) }}%
                        </span>
                    @else
                        <span class="currency">Ksh.</span>
                        <span class="price_amount">{{ $product->price }}</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="cart">
            <form action="{{ route('add_to_cart', $product->id) }}" method="post">
                @csrf
                <button type="submit">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M352 160v-32C352 57.4 294.6 0 224 0 153.4 0 96 57.4 96 128v32H0v272c0 44.2 35.8 80 80 80h288c44.2 0 80-35.8 80-80V160h-96zm-192-32c0-35.3 28.7-64 64-64s64 28.7 64 64v32H160v-32zm160 120c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm-192 0c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24z"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
