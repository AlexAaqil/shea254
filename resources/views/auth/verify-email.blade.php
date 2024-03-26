<x-app-layout>
    <section class="Authentication">
        <div class="container verify_email">
            <div class="header">
                <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>
            </div>
            @if(session('status') == 'verification-link-sent')
                <p>A new verification link has been sent to the email address you provided during registration.</p>
            @endif
            <div class="custom_form">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
        
                    <button type="submit">Resend Verification Email</button>
                </form>
            </div>
        </div>
    </section>

    {{-- <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div> --}}
</x-app-layout>
