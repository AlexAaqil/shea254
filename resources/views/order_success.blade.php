<x-app-layout>
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
            <p>Please enter your M-PESA PIN to complete this order.</p>
            <p>We will contact you in case we need any clarification.</p>

            <!-- Display payment response details -->
            @if($paymentResponse)
                <h2>Payment Response Details</h2>
                <ul>
                    <li>Status: {{ $paymentResponse['status'] }}</li>
                    <li>Merchant Request ID: {{ $paymentResponse['MerchantRequestID'] }}</li>
                    <li>Checkout Request ID: {{ $paymentResponse['CheckoutRequestID'] }}</li>
                    <!-- Add other payment response details as needed -->
                </ul>
            @endif

            <div class="actions">
                <a href="{{ route('shop') }}" class="action_btn">Continue Shopping</a>
            </div>
        </div>
    </main>
    
    @include('partials.footer')
</x-app-layout>
