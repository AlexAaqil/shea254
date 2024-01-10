@extends('partials.base')
@section('content')
@include('partials.navbar')
<main class="Checkout Cart">
    <div class="container">
        <div class="header">
            <h1>Billing information</h1>
        </div>

        <div class="body">
            <div class="custom_form">
                <form action="" method="post">
                    <div class="row_input_group">
                        <div class="input_group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                        </div>

                        <div class="input_group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                        </div>
                    </div>

                    <div class="row_input_group">
                        <div class="input_group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="input_group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required>
                        </div>
                    </div>

                    <div class="input_group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}" required>
                    </div>

                    <div class="row_input_group">
                        <div class="input_group">
                            <label for="city">City</label>
                            <select name="city" id="city">
                                <option value="">Select City</option>
                                <option value="Nairobi">Nairobi</option>
                            </select>
                        </div>

                        <div class="input_group">
                            <label for="town">Town</label>
                            <select name="town" id="town">
                                <option value="">Select Town</option>
                                <option value="Moi Avenue">Moi Avenue</option>
                            </select>
                        </div>
                    </div>

                    <div class="input_group">
                        <label for="additional_information">Additional Information</label>
                        <textarea name="additional_information" id="additional_information" cols="30" rows="7" placeholder="Extra Information... (e.g) Specific Location"></textarea>
                    </div>

                    <button type="submit">Confirm Order</button>
                </form>
            </div>

            <div class="summary">
                <h1>Order Summary</h1>
                <p>
                    <span>Cart Items</span>
                    <span>{{ Session::get('cart_count', 0) }}</span>
                </p>
                <p>
                    <span>Cart Total</span>
                    <span>Ksh. {{ $cart['subtotal'] }}</span>
                </p>
            </div>
        </div>
    </div>
</main>
@endsection
