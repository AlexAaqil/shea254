@extends('partials.base')
@section('content')
@include('partials.navbar')
<main class="Categorised_Products">
    <section class="Products">
        <div class="hero">
            <div class="breadcrumb">
                <a href="{{ route('shop') }}">Shop</a> / {{ $query }}
            </div>

            <h1>{{ $query }}</h1>
            <p><strong>{{ $products->count() }}</strong> products matched your query.</p>
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
