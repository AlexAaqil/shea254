@extends('partials.base')

@section('content')
<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Categories">
        <div class="container">
            <div class="header">
                <h1>Categories</h1>
                <input type="text" name="search" id="myInput" placeholder="Search" onkeyup="searchFunction()" />
                <div class="header_btn">
                    <a href="{{ route('get_add_category') }}">New</a>
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
                                    <a href="{{ route('get_update_category', ['id'=>$value->id]) }}">
                                        <i class="fas fa-pencil-alt update"></i>
                                    </a>
                                </div>
                                <div class="action">
                                    <form id="deleteForm_{{ $value->id }}" action="{{ route('delete_category', ['id' => $value->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <a href="javascript:void(0);" onclick="deleteItem({{ $value->id }}, 'category');">
                                            <i class="fas fa-trash-alt delete"></i>
                                        </a>
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
