@extends('partials.base')
@section('content')

<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Orders">
        <div class="container">
            <div class="custom_form">
                <h1>Update Order</h1>
                <div class="order_details">
                    <div class="details">
                        <p class="text-success">
                            <span>Order_number</span>
                            <span>{{ $order->order_number }}</span>
                        </p>
                        <p>
                            <span>Names</span>
                            <span>{{ $order->first_name }} {{ $order->last_name }}</span>
                        </p>
                        <p>
                            <span>Email Address</span>
                            <span>{{ $order->email }}</span>
                        </p>
                        <p>
                            <span>Phone Number</span>
                            <span>{{ $order->phone_number }}</span>
                        </p>
                        <p>
                            <span>Address</span>
                            <span>{{ $order->address }}</span>
                        </p>
                        <p>
                            <span>City</span>
                            <span>{{ $order->city }}</span>
                        </p>
                        <p>
                            <span>Town</span>
                            <span>{{ $order->town }}</span>
                        </p>
                        <p>
                            <span>Order Date</span>
                            <span>{{ $order->created_at->format('M d Y \a\t h:i A') }}</span>
                        </p>
                    </div>

                    <div class="cart_items">
                        <p class="bold">Items Ordered</p>
                        @php
                            $cart_items = json_decode($order->cart_items, true);
                        @endphp

                        <ul>
                        @foreach($cart_items as $product)
                        <li>
                            <span>{{ $product['title'] }}</span>
                            <span>{{ $product['quantity'] }}</span>
                            <span>@ Ksh. {{ $product['price'] }}</span>
                            <span>= Ksh. {{ $product['price'] * $product['quantity'] }}</span>
                        </li>
                        @endforeach
                        </ul>

                        <p>
                            <span>Shipping Cost</span>
                            <span>{{ $order->shipping_cost }}</span>
                        </p>
                        <p class="text-success">
                            <span>Total Amount</span>
                            <span>{{ $order->total_amount }}</span>
                        </p>
                    </div>
                </div>
                <form action="" method="post">
                    @csrf

                    <div class="input_group">
                        <label for="additional_information">Additional Information</label>
                        <input type="text" name="additional_information" id="additional_information" placeholder="Extra Information... (e.g) Specific Location" value="{{ $order ? $order->additional_information : old('additional_information') }}">
                        <span class="inline_alert">{{ $errors->first('additional_information') }}</span>
                    </div>

                    <div class="row_input_group">
                        <div class="input_group">
                            <label for="status">Order Status</label>
                            <select name="status" id="status">
                                <option value="" {{ !$order || $order->status == '' ? 'selected' : ''}}>Select Order Status</option>
                                <option value="pending" {{ ($order && $order->status == 'pending') ? 'selected' : '' }}>Pending</option>
                                <option value="processed" {{ ($order && $order->status == 'processed') ? 'selected' : '' }}>Processed</option>
                            </select>
                            <span class="inline_alert">{{ $errors->first('status') }}</span>
                        </div>

                        <div class="input_group">
                            <label for="paid">Payment Status</label>
                            <select name="paid" id="paid">
                                <option value="" {{ !$order || $order->paid == '' ? 'selected' : '' }}>Select Payment Status</option>
                                <option value="1" {{ ($order && $order->paid == 1) ? 'selected' : '' }}>Paid</option>
                                <option value="0" {{ ($order && $order->paid == 0) ? 'selected' : '' }}>Not Paid</option>
                            </select>
                            <span class="inline_alert">{{ $errors->first('paid') }}</span>
                        </div>
                    </div>

                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </section>
</main>
@endsection
