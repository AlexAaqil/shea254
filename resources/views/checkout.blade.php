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
                    @csrf
                    <div class="row_input_group">
                        <div class="input_group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ $user ? $user->first_name : old('first_name') }}">
                            <span class="inline_alert">{{ $errors->first('first_name') }}</span>
                        </div>

                        <div class="input_group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ $user ? $user->last_name : old('last_name') }}">
                            <span class="inline_alert">{{ $errors->first('last_name') }}</span>
                        </div>
                    </div>

                    <div class="row_input_group">
                        <div class="input_group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ $user ? $user->email : old('email') }}">
                            <span class="inline_alert">{{ $errors->first('email') }}</span>
                        </div>

                        <div class="input_group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" value="{{ $user ? $user->phone_number : old('phone_number') }}">
                            <span class="inline_alert">{{ $errors->first('phone_number') }}</span>
                        </div>
                    </div>

                    <div class="input_group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" value="{{ $user ? $user->address : old('address') }}">
                        <span class="inline_alert">{{ $errors->first('address') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="additional_information">Additional Information</label>
                        <input type="text" name="additional_information" id="additional_information" placeholder="Extra Information... (e.g) Specific Location" value="{{ $user ? $user->additional_information : old('additional_information') }}">
                        <span class="inline_alert">{{ $errors->first('additional_information') }}</span>
                    </div>

                    <div class="row_input_group">
                        <div class="input_group">
                            <label for="city">City</label>
                            <select name="city" id="city">
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">
                                        {{ $city->city_name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="inline_alert">{{ $errors->first('city') }}</span>
                        </div>

                        <div class="input_group">
                            <label for="town">Town</label>
                            <select name="town" id="town">
                                <option value="">Select Town</option>
                                @foreach($towns as $town)
                                    <option value="{{ $town->id }}">
                                        {{ $town->town_name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="inline_alert">{{ $errors->first('town') }}</span>
                        </div>
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
                    <span>Shipping Cost</span>
                    <span id="shipping_cost_amount">0</span>
                </p>
                <p class="total">
                    <span>Total</span>
                    <span id="total_amount">Ksh. {{ $cart['subtotal'] }}</span>
                </p>
            </div>
        </div>
    </div>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const citySelect = document.getElementById("city");
        const townSelect = document.getElementById("town");
        const shippingCostElement = document.getElementById("shipping_cost_amount");
        const totalElement = document.getElementById("total_amount");

        // Function to update shipping cost and total
        function updateShippingAndTotal(townPrice) {
            const shippingCost = townPrice; // Use town's price as shipping cost
            const cartSubtotal = {{ $cart['subtotal'] }}; // Get cart subtotal from PHP

            // Update the DOM
            shippingCostElement.textContent = `Ksh. ${shippingCost.toFixed(2)}`;
            totalElement.textContent = `Ksh. ${(shippingCost + cartSubtotal).toFixed(2)}`;
        }

        citySelect.addEventListener("change", function () {
            const selectedCityId = this.value;

            // Make an Ajax request to fetch towns based on the selected city
            fetch(`/towns/fetch/${selectedCityId}`)
                .then(response => response.json())
                .then(data => {
                    // Clear and update the towns select box
                    townSelect.innerHTML = "";
                    townSelect.add(new Option("Select Town", ""));

                    data.forEach(town => {
                        townSelect.add(new Option(town.town_name, town.id));
                    });
                });
        });

        townSelect.addEventListener("change", function () {
            const selectedTownId = this.value;

            // Make an Ajax request to fetch the selected town's price
            fetch(`/town/fetch/shipping-price/${selectedTownId}`)
                .then(response => response.json())
                .then(data => {
                    const townPrice = data.price;

                    // Trigger update with the town's price
                    updateShippingAndTotal(townPrice);
                });
        });
    });
</script>
@endsection
