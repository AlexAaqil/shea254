@extends('partials.base')

@section('content')
<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Locations">
         @include('partials.messages')
        <div class="container">
            <div class="header">
                <h1>Cities</h1>
                <input type="text" name="search" id="myInput" placeholder="Search" onkeyup="searchFunction()" />
                <div class="header_btn">
                    <a href="{{ route('get_add_city') }}">New</a>
                </div>
            </div>



            <div class="body">
                <table>
                    <thead>
                        <tr>
                            <th>City</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cities as $city)
                        <tr class="searchable">
                            <td>{{ $city->city_name }}</td>
                            <td class="actions">
                                 <div class="action">
                                    <a href="{{ route('get_update_city', ['id'=>$city->id]) }}">
                                        <i class="fas fa-pencil-alt update"></i>
                                    </a>
                                </div>
                                <div class="action">
                                    <form id="deleteForm_{{ $city->id }}" action="{{ route('delete_city', ['id' => $city->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" onclick="deleteItem({{ $city->id }}, 'city');">
                                            <i class="fas fa-trash-alt delete"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container">
            <div class="header">
                <h1>Towns</h1>
                <input type="text" name="search" id="myInput" placeholder="Search" onkeyup="searchFunction()" />
                <div class="header_btn">
                    <a href="{{ route('get_add_town') }}">New</a>
                </div>
            </div>

            <div class="body">
                <table>
                    <thead>
                        <tr>
                            <th>Town</th>
                            <th>Price (Ksh.)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($towns as $town)
                        <tr class="searchable">
                            <td>{{ $town->town_name }}</td>
                            <td>{{ $town->price }}</td>
                            <td class="actions">
                                 <div class="action">
                                    <a href="{{ route('get_update_town', ['id'=>$town->id]) }}">
                                        <i class="fas fa-pencil-alt update"></i>
                                    </a>
                                </div>
                                <div class="action">
                                    <form id="deleteForm_{{ $town->id }}" action="{{ route('delete_town', ['id' => $town->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" onclick="deleteItem({{ $town->id }}, 'town');">
                                            <i class="fas fa-trash-alt delete"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
@include('partials.javascripts')
@endsection
