@extends('partials.base')

@section('content')
<main class="Admin">
    @include('admin.sidenav')
    <section class="Main ProductSizes">
        <div class="container">
            <div class="custom_form">
                <h1>Add Product Size</h1>
                <form action="" method="post">
                    @csrf
                    <div class="input_group">
                        <label for="product_size">Product Size</label>
                        <input type="text" name="product_size" id="product_size" value="{{ old('product_size') }}" required autofocus />
                        <span class="inline_alert">{{ $errors->first('product_size') }}</span>
                    </div>

                    <button type="submit">Save</button>
                </form>
            </div>
        </div>
    </section>
</main>
@include('partials.javascripts')
@endsection
