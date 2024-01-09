@extends('partials.base')

@section('content')
<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Dashboard">
        <div class="container">
            <h1>Dashboard</h1>

            <div class="statistics">
                <div class="static">
                    <div class="icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="text">
                        <p>Admins</p>
                        <p>{{ $count_admins }}</p>
                    </div>
                </div>

                <div class="static">
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="text">
                        <p>Users</p>
                        <p>{{ $count_users }}</p>
                    </div>
                </div>

                <div class="static">
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="text">
                        <p>Categories</p>
                        <p>{{ $count_categories }}</p>
                    </div>
                </div>

                <div class="static">
                    <div class="icon">
                        <i class="fas fa-store-alt"></i>
                    </div>
                    <div class="text">
                        <p>Products</p>
                        <p>{{ $count_products }}</p>
                    </div>
                </div>

                <div class="static">
                    <div class="icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="text">
                        <p>Orders</p>
                        <p>xxx</p>
                    </div>
                </div>

                <div class="static">
                    <div class="icon">
                        <i class="fas fa-balance-scale-left"></i>
                    </div>
                    <div class="text">
                        <p>Sales</p>
                        <p>xxx</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
@include('partials.javascripts')
@endsection
