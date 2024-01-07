<div class="admin_sidebar close">
    <div class="header">
        <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo" width=30 height=30 class="rounded">
        <h1>Shea254</h1>
        <i class="fas fa-chevron-right toggle"></i>
    </div>

    <div class="body">
        <ul class="list_style_none">
            <li class="nav-link">
                <a href="/home">
                    <i class="fas fa-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="#">
                    <i class="fas fa-users-cog"></i>
                    <span class="text">Admins</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="#">
                    <i class="fas fa-users"></i>
                    <span class="text">Users</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="#">
                    <i class="fas fa-tags"></i>
                    <span class="text">Categories</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="#">
                    <i class="fas fa-ruler-combined"></i>
                    <span class="text">Product Sizes</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="#">
                    <i class="fas fa-store-alt"></i>
                    <span class="text">Products</span>
                </a>
            </li>
            <li class="nav-link">
                <a href="#">
                    <i class="fas fa-truck"></i>
                    <span class="text">Orders</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="footer">
        <ul class="list_style_none">
            <li class="profile">
                <img src="{{ asset('assets/images/default_profile.jpg') }}" alt="Logo" width=40 height=40 class="rounded">
                <span class="text">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
            </li>
            <li class="logout">
                <a href="#">
                    <i class="fas fa-sign-out-alt icons"></i>
                    <span class="text">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</div>
