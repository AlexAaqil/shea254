@extends('partials.base')
@section('content')
@include('partials.navbar')
<main class="Orders">
    <div class="container">
        <h1>Orders</h1>
        <ul>
            @if(isset($user_orders) && count($user_orders) > 0)
            <p>You have placed <strong>{{ count($user_orders) }}</strong> {{ (count($user_orders) == 1) ? 'order' : 'orders' }}</p>
            @foreach($user_orders as $order)
            <li>
                <span>{{ $order->order_number }}</span>
                <span>Ksh. {{ number_format($order->total_amount) }}</span>
                <span class="{{ ($order->status == "processed") ? 'text-success' : '' }}">{{ $order->status }}
                    @if ($order->status == "processed")
                        <i class="fas fa-check"></i>
                    @endif
                </span>
                <span class="{{ ($order->paid == 0) ? 'text-danger' : 'text-success' }}">
                    {{ ($order->paid == 0) ? 'Not Paid' : 'Paid' }}
                </span>
                <span>{{ $order->created_at->format('F j, Y h:i A') }}</span>
            </li>
            @endforeach
            @else
                <p>You currently don't have any orders. Explore our products and place your first order!</p>
            @endif
        </ul>
    </div>
</main>
@include('partials.footer')
@endsection
