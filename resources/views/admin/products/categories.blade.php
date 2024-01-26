@extends('admin.partials.base')
@section('admin_content')
    <div class="container categories">
        @include('admin.products.products_navbar')

        <div class="header">
            <h1>Categories</h1>
            <input type="text" name="search" id="myInput" placeholder="Search" onkeyup="searchFunction()" />
            <div class="header_btn">
                <a href="{{ route('categories.create') }}">New</a>
            </div>
        </div>

        <div class="body">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $value)
                    <tr class="searchable">
                        <td>{{ $value->title }}</td>
                        <td>{{ $value->slug }}</td>
                        <td class="actions">
                                <div class="action">
                                <a href="{{ route('categories.edit', ['category'=>$value->id]) }}">
                                    <i class="fas fa-pencil-alt update"></i>
                                </a>
                            </div>
                            <div class="action">
                                <form id="deleteForm_{{ $value->id }}" action="{{ route('categories.destroy', ['category' => $value->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="deleteItem({{ $value->id }}, 'category');">
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
