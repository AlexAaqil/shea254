<x-admin>
    <section class="Products">
        <div class="container products">
            @include('admin.partials.products_navbar')
    
            <div class="header">
                <h1>Products <span>({{ $products->count() }})</span></h1>
                <x-js_search></x-js_search>
                <div class="header_btn">
                    <a href="{{ route('products.create') }}">New</a>
                </div>
            </div>
    
            <div class="body">
                <div class="card_wrapper products">
                    @foreach($products as $product)
                    <div class="card product searchable">
                        <div class="image">
                            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="title">
                                <img src="{{ $product->getFirstImage() }}" alt="Product">
                            </a>
                        </div>
    
                        <div class="text">
                            <div class="extra_details">
                                <span>{{ $product->product_code }}</span>
                                <span>{{ $product->product_category ? $product->product_category->title : 'no category' }}</span>
                                <span class="{{ $product->stock_count == 0 ? 'out_of_stock' : 'in_stock' }}">{{ $product->stock_count == 0 ? 'out of stock' : 'in stock (' . $product->stock_count . ')' }}</span>
                                <span class="{{ $product->featured == 1 ? 'featured' : 'not_featured'}}">{{ $product->featured == 1 ? 'featured' : 'not featured'}}</span>
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
                                        <form id="deleteForm_{{ $product->id }}" action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
        
                                            <a href="javascript:void(0);" onclick="deleteItem({{ $product->id }}, 'product');">
                                                <i class="fas fa-trash-alt delete"></i>
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <x-jquery_sweetalert></x-jquery_sweetalert>
</x-admin>
