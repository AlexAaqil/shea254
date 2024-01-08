@extends('partials.base')

@section('content')
<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Categories">
        <div class="container">
            <div class="custom_form">
                <h1>Add Category</h1>
                <form action="" method="post">
                    @csrf
                    <div class="input_group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required autofocus />
                        <span class="inline_alert">{{ $errors->first('title') }}</span>
                    </div>

                    <button type="submit">Save</button>
                </form>
            </div>
        </div>
    </section>
</main>
@include('partials.javascripts')
@endsection
