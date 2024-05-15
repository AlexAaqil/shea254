<x-app-layout>
    @include('partials.navbar')

    <section class="Dashboard">
        <div class="container">
            <h1>Hi {{ Auth::user()->first_name .' '. Auth::user()->last_name }}</h1>
            
            <div class="actions">
                <a href="" class="btn_link">
                    Update Profile
                </a>
                <div class="custom_form">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
        
                        <button type="submit" class="btn_danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
</x-app-layout>
