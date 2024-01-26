@extends('partials.base')
@section('content')

<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Locations">
        <div class="container">
            <div class="custom_form">
                <h1>Add Town</h1>
                <form action="" method="post">
                    @csrf
                    <div class="input_group">
                        <label for="city">City</label>
                        <select name="city_id" id="city_id">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                            @endforeach
                        </select>
                        <span class="inline_alert">{{ $errors->first('city_id') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="town_name">Town Name</label>
                        <input type="text" name="town_name" id="town_name" value="{{ old('town_name') }}" required />
                        <span class="inline_alert">{{ $errors->first('town_name') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" required />
                        <span class="inline_alert">{{ $errors->first('price') }}</span>
                    </div>

                    <button type="submit">Save</button>
                </form>
            </div>
        </div>
    </section>
</main>

@include('partials.javascripts')
@endsection
