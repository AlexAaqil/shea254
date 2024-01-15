<nav>
    <div class="nav_container">
        <a href="{{ route('homepage') }}" class="branding">
            <img src="{{ asset('/assets/images/logo.jpg') }}" width=40 height=40 alt="Logo" class="rounded">
            <h1>Shea254</h1>
        </a>


        <div class="nav_links" id="navLinks">
            <ul class="list_style_none">
                <li><a href="{{ route('shop') }}">Shop</a></li>
                <li><a href="{{ route('aboutpage') }}">About</a></li>
                <li><a href="{{ route('contactpage') }}">Contact</a></li>
                <li class="cart">
                    <a href="{{ route('cart') }}">
                        <i class="fas fa-shopping-bag"></i>
                        <span>{{ Session::get('cart_count', 0) }}</span>
                    </a>
                </li>
                <li class="authentication">
                    @if(Route::has('login'))
                    @auth
                    <a href="{{ url('/home') }}">{{ Auth::user()->first_name }}</a>
                    @else
                    <a href="{{ route('login') }}">Login</a>
                    @endauth
                    @endif
                </li>
            </ul>
        </div>

        <div class="burger_menu">
            <div class="burger_icon" id="burgerIcon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</nav>
