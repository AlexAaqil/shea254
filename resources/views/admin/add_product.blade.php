@extends('partials.base')

@section('content')
<main class="Admin">
    @include('admin.sidenav')
    <section class="Main ProductSizes">
        <div class="container">
            <div class="custom_form">
                <h1>Add Product</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input_group">
                        <label for="title">Title<span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Title" required autofocus />
                        <span class="inline_alert">{{ $errors->first('title') }}</span>
                    </div>

                    <div class="row_input_group">
                        <div class="input_group">
                            <label for="in_stock">In Stock</label>
                            <div class="custom_radio_buttons">
                                <label>
                                    <input class="option_radio" type="radio" name="in_stock" id="in_stock" value="1">
                                    <span>Yes</span>
                                </label>

                                <label>
                                    <input class="option_radio" type="radio" name="in_stock" id="not_in_stock" value="0">
                                    <span>No</span>
                                </label>
                            </div>
                        </div>

                        <div class="input_group">
                            <label for="featured">Featured</label>
                            <div class="custom_radio_buttons">
                                <label>
                                    <input class="option_radio" type="radio" name="featured" id="featured" value="1">
                                    <span>Yes</span>
                                </label>

                                <label>
                                    <input class="option_radio" type="radio" name="featured" id="not_featured" value="0">
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row_input_group">
                        <div class="input_group">
                            <label for="price">Price<span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" placeholder="Enter the Price eg. 50.00" />
                        </div>

                        <div class="input_group">
                            <label for="discount_price">New Price</label>
                            <input type="number" step="0.01" name="discount_price" id="discount_price" value="{{ old('discount_price') }}" placeholder="Enter the New Price eg. 30.00 if there's a discount or offer" />
                        </div>
                    </div>

                    <div class="row_input_group">
                        <div class="input_group">
                            <label for="category_id">Category<span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" value="{{ old('category_id') }}">
                                <option value="null">select</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input_group">
                            <label for="product_size_id">Size</label>
                            <select name="product_size_id" id="product_size_id" value="{{ old('product_size_id') }}">
                                <option value="null">select</option>
                                @foreach($product_sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->product_size }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="input_group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="7" value="{{ old('description') }}" placeholder="Enter a Description"></textarea>
                        <span class="inline_alert">{{ $errors->first('description') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="images">Images (Maximum allowed images is 5)</label>
                        <input type="file" name="images[]" id="images" accept=".png, .jpg, .jpeg" multiple />
                    </div>

                    <button type="submit">Save</button>
                </form>
            </div>
        </div>
    </section>
</main>
@include('partials.javascripts')
@endsection
