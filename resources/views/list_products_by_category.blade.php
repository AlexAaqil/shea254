@extends('partials.base')
@section('content')
@include('partials.navbar')
<main class="Categorised_Products">
    <section class="Products">
        <div class="hero">
            <div class="breadcrumb">
                <a href="{{ route('shop') }}">Shop</a> / {{ $category->title }}
            </div>

            <h1>{{$category->title}}</h1>
            <p>There's <strong>{{ $products->count() }}</strong> products in the <strong>{{ $category->title }}</strong> category</p>
        </div>

        <div class="category_list">
            @foreach($categories as $category)
                <a href="{{ route('list_products_by_category', $category->slug) }}">{{ $category->title }}</a>
            @endforeach
        </div>

        <div class="container">
            @include('partials.messages')
            <div class="products_wrapper">
                @foreach($products as $product)
                    @include('partials.product')
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
