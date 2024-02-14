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
                @if($product->product_size != null)
                <span>{{ $product->product_size }}</span>
                @endif
            </div>

            <div class="info">
                <p class="title">
                    <a href="{{ route('product_details', $product->slug) }}">
                        {{ $product->title }}
                    </a>
                </p>
                <p class="price_details">
                    @if($product->discount_price != 0.00 && $product->discount_price < $product->price)
                        <span class="currency">Ksh.</span>
                        <span class="price_amount discount">{{ $product->discount_price }}</span>
                        <span class="original_price text-danger">
                            <del>{{ $product->price }}</del>
                        </span>
                        <span class="discount_percentage">
                            {{ round($product->discount_percentage) }}% off
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
                    <i class="fa fa-shopping-cart"></i>
                </button>
            </form>
        </div>
    </div>
</div>
