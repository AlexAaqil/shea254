<x-admin>
    <div class="hero">
        <p>Hi {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
    </div>
</x-admin>