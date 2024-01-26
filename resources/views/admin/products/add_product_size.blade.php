@extends('admin.partials.base')
@section('admin_content')
    <div class="container product_sizes">
        <div class="custom_form">
            <h1>New Product Size</h1>
            <form action="{{ route('productsizes.store') }}" method="post">
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
@endsection
