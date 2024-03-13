@extends('partials.base')
@include('partials.navbar')
@section('content')
    <div class="container authentication login">
        <div class="header">
            <a href="{{ route('homepage') }}">
                <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo Image">
            </a>
        </div>

        <div class="custom_form">
            @include('partials.messages')
            <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

            <form action="{{ route('password.email') }}" method="post">
                @csrf

                <div class="input_group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}">
                    <span class="inline_alert">{{ $errors->first('email') }}</span>
                </div>

                <button type="submit">Email Password Reset Link</button>
            </form>
        </div>
    </div>
@endsection
