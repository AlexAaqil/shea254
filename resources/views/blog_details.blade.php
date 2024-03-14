@extends('partials.base')

@section('content')
@include('partials.navbar')

<main class="Blog">
    <section class="Hero">
        <div class="hero_content">
            <div class="breadcrumb">
                <a href="{{ route('homepage') }}">Home</a>
                <a href="{{ route('users.blogs') }}">Blogs</a>
            </div>
            <h1>Shea.254 Blog</h1>
        </div>
    </section>

    <section class="Blogs">
        <div class="blog blog_details">
            <div class="image">
                <a href="{{ route('blogs.show', ['slug' => $blog->slug]) }}">
                    <img src="{{ $blog->getImageUrl() }}" alt="Blog Image">
                </a>
            </div>
            <div class="container">
                <div class="text">
                    <span class="date">
                        {{ $blog->created_at->diffForHumans() }}
                    </span>
                    <h1>{{ $blog->title }}</h1>
                    <span class="content">
                        {!! html_entity_decode($blog->content) !!}
                    </span>
                    <div class="btn">
                        <a href="{{ route('users.blogs') }}"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@include('partials.footer')
@endsection
