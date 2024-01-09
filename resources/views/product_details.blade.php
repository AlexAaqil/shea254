@extends('partials.base')
@section('content')
@include('partials.navbar')
<main class="Product_details">
    @include('partials.messages')
    <div class="container">
        <div class="wrapper">
            <div class="images">
                {{-- @php dd($product_images) @endphp --}}
                <img src="{{ $product->getFirstImage() }}" alt="{{ $product->title }}">
                <div class="other_images">
                    {{-- <img src="{{ $product->getFirstImage() }}" alt="{{ $product->title }}"> --}}
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
                            <i class="fas fa-shopping-bag add_to_cart_btn"></i> Add to Bag
                        </button>
                    </form>
                </div>

                <p class="description">{{ $product->description }}</p>

                <div class="extras">
                    <p>
                        <span>Size</span>
                        <span>{{ $product->product_size->product_size }}</span>
                    </p>
                    <p>
                        <span>Category</span>
                        <span>{{ $product->category->title }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
