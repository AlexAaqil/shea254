<div class="card product_card">
    <div class="image">
        <a href="{{ route('products.details', ['slug' => $product->slug]) }}">
            <img src="{{ $product->getFirstImage() }}" alt="{{ $product->title }}">
        </a>

        @if($product->discount_price != 0.00 && $product->discount_price < $product->selling_price)
            <span class="percentage_discount">
                {{ round($product->calculateDiscount()) }}% off
            </span>
        @endif

        <div class="actions">
            <div class="action">
                <form action="{{ route('cart.store', $product->id) }}" method="POST">
                    @csrf

                    <button type="submit">
                        <i class="fa fa-cart-plus"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="details">
        <div class="extra_details">
            @if($product->product_category)
                <span>
                    <a href="{{ route('products.categorized', $product->product_category->slug) }}">
                        {{ $product->product_category->title }}
                    </a>
                </span>
            @endif
        </div>
        
        <div class="content">
            <div class="info">
                <div class="title">
                    <a href="{{ route('products.details', ['slug' => $product->slug]) }}">{{ $product->title }}</a>
                </div>

                <div class="price_rating">
                    <span class="price">
                        @if($product->discount_price != 0.00 && $product->discount_price < $product->selling_price)
                            <span class="new_price">Ksh. {{ $product->discount_price }}</span>
                            <span class="old_price"><del>Ksh. {{ $product->selling_price }}</del></span>
                        @else
                            <span class="new_price">Ksh. {{ $product->selling_price }}</span>
                        @endif
                    </span>

                    @if($product->product_reviews->count() > 5)
                        <span class="rating">
                            <span><i class="fas fa-star"></i> {{ number_format($product->average_rating(), 1) }} ({{ $product->product_reviews->count() }} reviews)</span>
                        </span>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>