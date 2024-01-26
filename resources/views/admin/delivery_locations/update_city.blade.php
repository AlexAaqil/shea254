@extends('partials.base')
@section('content')

<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Locations">
        <div class="container">
            <div class="custom_form">
                <h1>Update City</h1>
                <form action="" method="post">
                    @csrf
                    <div class="input_group">
                        <label for="city_name">City</label>
                        <input type="text" name="city_name" id="city_name" value="{{ old('city_name', $city->city_name) }}" required />
                        <span class="inline_alert">{{ $errors->first('city_name') }}</span>
                    </div>

                    <button type="submit">Save</button>
                </form>
            </div>
        </div>
    </section>
</main>

@include('partials.javascripts')
@endsection
