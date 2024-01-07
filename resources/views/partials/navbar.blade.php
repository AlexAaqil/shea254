<nav>
    <div class="nav_container">
        <a href="{{ route('homepage') }}" class="branding">
            <img src="{{ asset('/assets/images/logo.jpg') }}" alt="Logo" class="rounded">
            <h1>Shea254</h1>
        </a>

        <ul class="list_style_none">
            <li><a href="#">Shop</a></li>
            <li><a href="{{ route('aboutpage') }}">About</a></li>
            <li><a href="{{ route('contactpage') }}">Contact</a></li>
            <li class="cart">
                <i class="fas fa-shopping-bag"></i>
                <span>0</span>
            </li>
            <li class="authentication">
                @if(Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                @endif
            </li>
        </ul>
    </div>
</nav>
