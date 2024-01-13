@extends('partials.base')
@section('content')
@include('partials.navbar')
<main class="Order_success">
    <div class="container">
        @include('partials.messages')
        <h1>Success</h1>
        <p>Your order (<strong>{{ $order_number }}</strong>) has been submitted. We will contact you in case we need any clarification.</p>
    </div>
</main>
@endsection
