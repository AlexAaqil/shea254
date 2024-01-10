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
            <iframe src="https://www.google.com/maps/embed?pb=!4v1704873969482!6m8!1m7!1shKQQXmmhUyA217YG-i6CVQ!2m2!1d--1.282568713790881!2d36.823056679483564!3f27.684283364789728!4f0.9439519594547505!5f0.7820865974627469" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
</main>
@include('partials.footer')
@endsection
