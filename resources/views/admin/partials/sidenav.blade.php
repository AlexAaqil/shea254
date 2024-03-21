<aside class="admin_sidebar">
    <div class="branding">
        <a href="{{ route('homepage') }}">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo" width=30 height=30 class="rounded">
        </a>
        <h1>{{ config('app.name') }}</h1>
    </div>

    <div class="nav_links">
        <ul class="list_style_none">
            <li class="nav-link">
                <a href="/home">
                    <i class="fas fa-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="{{ route('list_admins') }}">
                    <i class="fas fa-users-cog"></i>
                    <span class="text">Admins</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="{{ route('list_users') }}">
                    <i class="fas fa-users"></i>
                    <span class="text">Users</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="{{ route('products.index') }}">
                    <i class="fas fa-barcode"></i>
                    <span class="text">Products</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="{{ route('locations.index') }}">
                    <i class="fas fa-map-marker-alt"></i>
                    <span class="text">Locations</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="{{ route('list_orders') }}">
                    <i class="fas fa-truck-loading"></i>
                    <span class="text">Orders</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="{{ route('blogs.index') }}">
                    <i class="fas fa-blog"></i>
                    <span class="text">Blogs</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="{{ route('comments.index') }}">
                    <i class="fas fa-comment"></i>
                    <span class="text">Comments</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="footer">
        <ul class="list_style_none">
            <li class="profile">
                <img src="{{ asset('assets/images/default_profile.jpg') }}" alt="Logo" width=40 height=40 class="rounded">
                <span class="text">
                    <a href="{{ route('profile.edit') }}">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </a>
                </span>
            </li>
            <li class="logout">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">
                        <i class="fas fa-sign-out-alt icons"></i>
                        <span class="text">Log Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
