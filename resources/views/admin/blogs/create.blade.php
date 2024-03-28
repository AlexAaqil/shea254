@extends('admin.partials.base')
@section('head')
<script src="https://cdn.tiny.cloud/1/44zgxk9rangxvjd8no219bfrmnon247y18bl2fylec4zpa55/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('admin_content')
    <div class="container products">
        <div class="custom_form">
            <h1>Add Product</h1>
            <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="input_group">
                    <label for="image">Thumbnail</label>
                    <input type="file" name="image" id="image" />
                    <span class="inline_alert">{{ $errors->first('image') }}</span>
                </div>

                <div class="input_group">
                    <label for="title">Title<span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Title" autofocus />
                    <span class="inline_alert">{{ $errors->first('title') }}</span>
                </div>

                <div class="input_group">
                    <label for="content">Content<span class="text-danger">*</span></label>
                    <textarea name="content" id="content" class="tinymiced" rows="7" placeholder="Enter the Blog's Content">{{ old('content') }}</textarea>
                    @error('content')
                        <span class="inline_alert">{{ $errors->first('content') }}</span>
                    @enderror
                </div>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection

@section('additional_javascript')
<script src="{{ asset('assets/js/tinymce.js') }}"></script>
@endsection
