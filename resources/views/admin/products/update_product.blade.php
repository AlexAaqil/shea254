@extends('admin.partials.base')
@section('admin_content')
    <div class="container products">
        <div class="custom_form">
            <h1> Update Product</h1>
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input_group">
                    <label for="title">Title<span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $product->title) }}" placeholder="Title" required />
                    <span class="inline_alert">{{ $errors->first('title') }}</span>
                </div>

                <div class="row_input_group">
                    <div class="input_group">
                        <label for="in_stock">In Stock</label>
                        <div class="custom_radio_buttons">
                            <label>
                                <input class="option_radio" type="radio" name="in_stock" id="in_stock" value="1" {{ $product->in_stock == 1 ? 'checked' : '' }}>
                                <span>Yes</span>
                            </label>

                            <label>
                                <input class="option_radio" type="radio" name="in_stock" id="not_in_stock" value="0" {{ $product->in_stock == 0 ? 'checked' : '' }}>
                                <span>No</span>
                            </label>
                        </div>
                    </div>

                    <div class="input_group">
                        <label for="featured">Featured</label>
                        <div class="custom_radio_buttons">
                            <label>
                                <input class="option_radio" type="radio" name="featured" id="featured" value="1" {{ $product->featured == 1 ? 'checked' : '' }}>
                                <span>Yes</span>
                            </label>

                            <label>
                                <input class="option_radio" type="radio" name="featured" id="not_featured" value="0" {{ $product->featured == 0 ? 'checked' : '' }}>
                                <span>No</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row_input_group">
                    <div class="input_group">
                        <label for="price">Price<span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" placeholder="Enter the Price eg. 50.00" />
                        <span class="inline_alert">{{ $errors->first('price') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="discount_price">New Price</label>
                        <input type="number" step="0.01" name="discount_price" id="discount_price" value="{{ old('discount_price', $product->discount_price) }}" placeholder="Enter the New Price eg. 30.00 if there's a discount or offer" />
                        <span class="inline_alert">{{ $errors->first('discount_price') }}</span>
                    </div>
                </div>

                <div class="row_input_group_3">
                    <div class="input_group">
                        <label for="category_id">Category<span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id">
                            <option value="">select</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                        <span class="inline_alert">{{ $errors->first('category_id') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="product_size_id">Size<span class="text-danger">*</span></label>
                        <select name="product_size_id" id="product_size_id">
                            <option value="">select</option>
                            @foreach($product_sizes as $size)
                                <option value="{{ $size->id }}" {{ (old('product_size_id', $product->product_size_id) == $size->id) ? 'selected' : '' }}>
                                    {{ $size->product_size }}
                                </option>
                            @endforeach
                        </select>
                        <span class="inline_alert">{{ $errors->first('product_size_id') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="order">Order</label>
                        <input type="number" name="order" id="order" min="1" value={{ $product->order }}>
                    </div>
                </div>

                <div class="input_group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="7">{{ $product->description }}</textarea>
                    <span class="inline_alert">{{ $errors->first('description') }}</span>
                </div>

                <div class="input_group">
                    <label for="images">Images (Maximum allowed images is 5)</label>
                    <input type="file" name="images[]" id="images" accept=".png, .jpg, .jpeg" multiple />
                    <span class="inline_alert">{{ session('error') ? session('error') : ($errors->has('images') ? $errors->first('images') : '') }}</span>
                </div>

                @if(!empty(session('success')))
                    <span class="inline_alert_success">{{ session('success') }}</span>
                @endif

                <div class="product_images" id="sortable">
                    @if(!empty($product_images->count()))
                        @foreach ($product_images as $image)
                            @if(!empty($image->getProductImageURL()))
                                <div class="product_image sortable_images" id={{ $image->id }}>
                                    <img src="{{ $image->getProductImageURL() }}" alt="{{ $image->image_name }}" />
                                    <a href="javascript:void(0);" onclick="deleteItem({{ $image->id }}, 'image', '{{ url('/admin/product/delete_product_image/'.$image->id) }}');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>

    @section('additional_javascript')
        <script>
            $(document).ready(function() {
            $("#sortable").sortable({
                update : function(event, ui) {
                    var photo_id = new Array();
                    $('.sortable_images').each(function() {
                        var id = $(this).attr('id');
                        photo_id.push(id);
                    });

                    $.ajax({
                        type : "POST",
                        url : "{{ url('admin/product/product_images_sort') }}",
                        data : {
                            "photo_id" : photo_id,
                            "_token" : "{{ csrf_token() }}"
                        },
                        dataType : "json",
                        success : function(data) {

                        },
                        error : function (data) {

                        }
                    });
                }
            });
        });
        </script>
    @endsection
@endsection
