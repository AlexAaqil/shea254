@extends('admin.partials.base')

@section('admin_content')
    <div class="container delivery_locations">
        @include('admin.delivery_locations.locations_navbar')

        <div class="header">
            <h1>Areas</h1>
            @include('admin.partials.search_bar')
            <div class="header_btn">
                <a href="{{ route('areas.create') }}">New</a>
            </div>
        </div>

        <div class="body">
            <table>
                <thead>
                    <tr>
                        <th>Delivery Area</th>
                        <th>Price (Kshs.)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($delivery_areas as $value)
                        <tr class="searchable">
                            <td class="area">{{ $value->area_name }} <span class="area_extra_info">{{ $value->location->location_name }}</span></td>
                            <td>{{ $value->price }}</td>
                            <td class="actions">
                                <div class="action">
                                    <a href="{{ route('areas.edit', ['area'=>$value->id]) }}">
                                        <i class="fas fa-pencil-alt update"></i>
                                    </a>
                                </div>
                                <div class="action">
                                    <form id="deleteForm_{{ $value->id }}" action="{{ route('areas.destroy', ['area' => $value->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" onclick="deleteItem({{ $value->id }}, 'delivery area');">
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
