@extends('partials.base')
@section('content')
@include('partials.navbar')
<main class="Orders">
    <div class="container">
        <h1>Orders</h1>
        <ul>
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
        </ul>
    </div>
</main>
@include('partials.footer')
@endsection
