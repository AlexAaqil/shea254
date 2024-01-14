@extends('partials.base')
@section('content')
@include('partials.navbar')
<main class="Order_success">
    <div class="container">
        <div class="success-checkmark">
            <div class="check-icon">
                <span class="icon-line line-tip"></span>
                <span class="icon-line line-long"></span>
                <div class="icon-circle"></div>
                <div class="icon-fix"></div>
            </div>
        </div>

        <h1>Success</h1>
        <p>Your order (<strong>{{ $order_number }}</strong>) has been submitted.</p>
        <p>We will contact you in case we need any clarification.</p>

        <div class="actions">
            <a href="{{ route('list_user_orders') }}" class="btn btn--primary">View Orders</a>
            <a href="{{ route('shop') }}" class="action_btn">Continue Shopping</a>
        </div>
    </div>
</main>
@include('partials.footer')
@endsection
