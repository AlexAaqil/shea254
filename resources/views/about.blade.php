@extends('partials.base')

@section('content')
@include('partials.navbar')
<main class="About">
    <section class="Story">
        <div class="container">
            <h1 class="section_heading">Why Shea254?</h1>
            <div class="mission_statements">
                <div class="statement">
                    <h1>Naturally Grown</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, quo ut! Quo blanditiis laboriosam amet reprehenderit nisi quibusdam provident adipisci?</p>
                </div>

                <div class="statement">
                    <h1>Naturally Delivered</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium quasi inventore soluta nobis dicta explicabo!</p>
                </div>

                <div class="statement">
                    <h1>Naturally Manufactured</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium quasi inventore soluta nobis dicta explicabo!</p>
                </div>
            </div>
        </div>
    </section>

    <section class="Location">
        <div class="container">
            <div class="details">
                <p>Nairobi CBD <br />Sasa Mall, Moi Avenue <br />Shop G20</p>
                <p>Business Hours: 08:00 A.M - 05:00 P.M</p>
            </div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d249.30116336649832!2d36.82289723358633!3d-1.2826447627655024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f11115fa70ed9%3A0x6e15dff148906f82!2ssasa%20mall!5e0!3m2!1sen!2ske!4v1703092238613!5m2!1sen!2ske"
                width="400"
                height="300"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </section>
</main>
@include('partials.footer')
@endsection
