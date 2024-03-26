<x-app-layout>
    <main class="Admin">
        @include('admin.partials.sidenav')

        <div class="admin_content">
            {{ $slot }}
        </div>
    </main>
</x-app-layout>