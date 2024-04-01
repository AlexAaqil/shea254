<x-app-layout>
    @include('partials.navbar')
    
    <main class="Shop">
        @include('partials.messages')

        <div class="search">
            <form action="{{ route('products.search') }}" method="GET">
                @csrf
                <input type="text" name="query" id="query" placeholder="Search Product">
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>

        <div class="container categories">
            @foreach($product_categories as $category)
                <a href="">{{ $category->title }}</a>
            @endforeach
        </div>

        <section class="shop_products">
            <div class="container">
                <div class="card_wrapper">
                    @foreach($products as $product)
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
</x-app-layout>