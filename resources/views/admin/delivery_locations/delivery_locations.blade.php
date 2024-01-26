@extends('admin.partials.base')

@section('admin_content')
    <div class="container delivery_locations">
        @include('admin.delivery_locations.locations_navbar')

        <div class="header">
            <h1>Locations</h1>
            <input type="text" name="search" id="myInput" placeholder="Search" onkeyup="searchFunction()" />
            <div class="header_btn">
                <a href="{{ route('locations.create') }}">New</a>
            </div>
        </div>

        <div class="body">
            <table>
                <thead>
                    <tr>
                        <th>Delivery Locations</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($delivery_locations as $value)
                        <tr>
                            <td>{{ $value->location_name }}</td>
                            <td class="actions">
                                <div class="action">
                                    <a href="{{ route('locations.edit', ['location'=>$value->id]) }}">
                                        <i class="fas fa-pencil-alt update"></i>
                                    </a>
                                </div>
                                <div class="action">
                                    <form id="deleteForm_{{ $value->id }}" action="{{ route('locations.destroy', ['location' => $value->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" onclick="deleteItem({{ $value->id }}, 'delivery location and associated areas');">
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
@endsection
