<nav>
    <div class="nav_container">
        <a href="{{ route('homepage') }}" class="branding">
            <img src="{{ asset('/assets/images/logo.jpg') }}" width=30 height=30 alt="Logo" class="rounded">
            <h1>Shea254</h1>
        </a>


        <div class="nav_links" id="navLinks">
            <ul class="list_style_none">
                <li><a href="{{ route('shop') }}">Shop</a></li>
                <li><a href="{{ route('aboutpage') }}">About</a></li>
                <li><a href="{{ route('contactpage') }}">Contact</a></li>
                <li class="cart">
                    <a href="{{ route('cart') }}">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M352 160v-32C352 57.4 294.6 0 224 0 153.4 0 96 57.4 96 128v32H0v272c0 44.2 35.8 80 80 80h288c44.2 0 80-35.8 80-80V160h-96zm-192-32c0-35.3 28.7-64 64-64s64 28.7 64 64v32H160v-32zm160 120c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm-192 0c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24z"/>
                        </svg>
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
