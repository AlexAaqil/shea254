<x-app-layout>
    <main class="Admin">
        @include('admin.partials.sidenav')

        <div class="admin_content">
            @include('partials.messages')
            {{ $slot }}
        </div>
    </main>
</x-app-layout>