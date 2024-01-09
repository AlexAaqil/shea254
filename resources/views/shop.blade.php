@extends('partials.base')
@section('content')
@include('partials.navbar')
<main class="Shop">
    <section class="Products">
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
