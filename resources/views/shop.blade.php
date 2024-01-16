@extends('partials.base')
@section('content')
@include('partials.navbar')
<main class="Shop">
    @include('partials.messages')
    <div class="search">
        <form action="{{ route('search_products') }}" method="GET">
            @csrf
            <input type="text" name="query" id="query" placeholder="Search Product">
            <button type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <section class="Products">
        <div class="container">
            <div class="products_wrapper">
                @foreach($products as $product)
                    @include('partials.product')
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
