@extends('admin.partials.base')
@section('admin_content')
    <div class="container categories">
        <div class="custom_form">
            <h1>Comment Details</h1>
            <p>{{ $comment->full_name }}</p>
            <p>{{ $comment->email_address }}</p>
            <p>{{ $comment->phone_number }}</p>
            <p>{{ $comment->message }}</p>
            <a href="{{ route('comments.index') }}">Go Back</a>
        </div>
    </div>
@endsection
