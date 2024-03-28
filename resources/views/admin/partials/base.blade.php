@extends('partials.base')
@section('content')
<main class="Admin">
    @include('partials.messages')
    @include('admin.partials.sidenav')
    <section class="Main">
        @yield('admin_content')
    </section>
</main>
@endsection
