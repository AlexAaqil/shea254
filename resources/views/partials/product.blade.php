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
                    <span class="currency">Ksh.</span>
                    <span class="price_amount">{{ $product->price }}</span>
                </p>
            </div>
        </div>

        <div class="cart">
            <form action="{{ route('add_to_cart', $product->id) }}" method="post">
                @csrf
                <button type="submit">
                    <i class="fas fa-shopping-bag add_to_cart_btn"></i>
                </button>
            </form>
        </div>
    </div>
</div>
