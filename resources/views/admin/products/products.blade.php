@extends('admin.partials.base')
@section('admin_content')
    <div class="container products">
        @include('admin.products.products_navbar')

        <div class="header">
            <h1>Products</h1>
            <input type="text" name="search" id="myInput" placeholder="Search" onkeyup="searchFunction()" />
            <div class="header_btn">
                <a href="{{ route('products.create') }}">New</a>
            </div>
        </div>

        <div class="body">
            <div class="products">
                @foreach($products as $product)
                <div class="product">
                    <div class="image">
                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="title">
                            <img src="{{ $product->getFirstImage() }}" alt="Product">
                        </a>
                    </div>

                    <div class="text">
                        <div class="details">
                            <div class="extras">
                                <span>{{ $product->category ? $product->category->title : 'null' }}</span>
                                <span>{{ $product->product_size ? $product->product_size : 'null' }}</span>
                                <span class="{{ $product->in_stock == 1 ? 'in_stock' : 'out_of_stock' }}">{{ $product->in_stock == 1 ? 'in stock' : 'out of stock'}}</span>
                                <span class="{{ $product->featured == 1 ? 'featured' : 'not_featured'}}">{{ $product->featured == 1 ? 'featured' : 'not featured'}}</span>
                            </div>

                            <div class="product_details">
                                <span>
                                    <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="title">
                                        {{ $product->title }}
                                    </a>
                                </span>
                                @if($product->discount_price != 0.00 && $product->discount_price < $product->price)
                                    <span class="price">
                                        <span class="currency">Ksh.</span>
                                        <span class="price_amount discount">{{ $product->discount_price }}</span>
                                        <span class="original_price text-danger">
                                            <del>{{ $product->price }}</del>
                                        </span>
                                        <span class="discount_percentage">
                                            {{ round($product->calculateDiscount()) }}% off
                                        </span>
                                    </span>
                                @else
                                    <span class="price">
                                        <span class="currency">Ksh.</span>
                                        <span class="price_amount">{{ $product->price }}</span>
                                    </span>
                                @endif
                            </div>
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
                @endforeach
            </div>
        </div>
    </div>
@endsection
