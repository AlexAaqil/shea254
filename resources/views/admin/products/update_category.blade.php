@extends('admin.partials.base')
@section('admin_content')
    <div class="container categories">
        <div class="custom_form">
            <h1>Update Category</h1>
            <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="input_group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $category->title) }}" required />
                    <span class="inline_alert">{{ $errors->first('title') }}</span>
                </div>

                <button type="submit">Update</button>
            </form>
        </div>
    </div>
@endsection
