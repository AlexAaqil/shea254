@extends('partials.base')

@section('content')
@include('partials.navbar')
<main class="Contact">
    <div class="container">
        <div class="contact_details">
            <p>+254 711 894 267</p>
            <p>shea.254@gmail.com</p>
        </div>

        <div class="contact_form">
            <form action="">
                <input type="text" name="full_name" id="full_name" placeholder="Full Name" autofocus />
                <input type="email" name="email_address" id="email_address" placeholder="Email Address" />
                <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" />
                <textarea name="message" id="message" cols="30" rows="7" placeholder="Enter your message"></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</main>
@include('partials.footer')
@endsection
