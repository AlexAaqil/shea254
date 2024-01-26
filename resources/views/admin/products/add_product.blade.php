@extends('admin.partials.base')
@section('admin_content')
    <div class="container products">
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
                                <input class="option_radio" type="radio" name="in_stock" id="in_stock" value="1" {{ old('in_stock') == '1' ? 'checked' : '' }}>
                                <span>Yes</span>
                            </label>

                            <label>
                                <input class="option_radio" type="radio" name="in_stock" id="not_in_stock" value="0" {{ old('in_stock') == '0' ? 'checked' : '' }}>
                                <span>No</span>
                            </label>
                        </div>
                        <span class="inline_alert">{{ $errors->first('in_stock') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="featured">Featured</label>
                        <div class="custom_radio_buttons">
                            <label>
                                <input class="option_radio" type="radio" name="featured" id="featured" value="1" {{ old('featured') == '1' ? 'checked' : '' }}>
                                <span>Yes</span>
                            </label>

                            <label>
                                <input class="option_radio" type="radio" name="featured" id="not_featured" value="0" {{ old('featured') == '0' ? 'checked' : '' }}>
                                <span>No</span>
                            </label>
                        </div>
                        <span class="inline_alert">{{ $errors->first('featured') }}</span>
                    </div>
                </div>

                <div class="row_input_group">
                    <div class="input_group">
                        <label for="price">Price<span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" placeholder="Enter the Price eg. 50.00" />
                        <span class="inline_alert">{{ $errors->first('price') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="discount_price">New Price</label>
                        <input type="number" step="0.01" name="discount_price" id="discount_price" value="{{ old('discount_price') }}" placeholder="Enter the New Price eg. 30.00 if there's a discount or offer" />
                    </div>
                    <span class="inline_alert">{{ $errors->first('discount_price') }}</span>
                </div>

                <div class="row_input_group_3">
                    <div class="input_group">
                        <label for="category_id">Category<span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" value="{{ old('category_id') }}">
                            <option value="">select</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        <span class="inline_alert">{{ $errors->first('category_id') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="product_size_id">Size</label>
                        <select name="product_size_id" id="product_size_id" value="{{ old('product_size_id') }}">
                            <option value="">select</option>
                            @foreach($product_sizes as $size)
                                <option value="{{ $size->id }}" {{ old('product_size_id') == $size->id ? 'selected' : '' }}>{{ $size->product_size }}</option>
                            @endforeach
                        </select>
                        <span class="inline_alert">{{ $errors->first('product_size_id') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="order">Order</label>
                        <input type="number" name="order" id="order" min="1">
                    </div>
                </div>

                <div class="input_group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="7" placeholder="Enter a Description">{{ old('description') }}</textarea>
                    <span class="inline_alert">{{ $errors->first('description') }}</span>
                </div>

                <div class="input_group">
                    <label for="images">Images (Maximum allowed images is 5)</label>
                    <input type="file" name="images[]" id="images" accept=".png, .jpg, .jpeg" multiple />
                    <span class="inline_alert">{{ $errors->first('images') }}</span>
                </div>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection
