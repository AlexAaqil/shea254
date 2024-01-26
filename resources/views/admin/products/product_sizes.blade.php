@extends('admin.partials.base')
@section('admin_content')
    <div class="container product_sizes">
        @include('admin.products.products_navbar')

        <div class="header">
            <h1>Product Sizes</h1>
            <input type="text" name="search" id="myInput" placeholder="Search" onkeyup="searchFunction()" />
            <div class="header_btn">
                <a href="{{ route('productsizes.create') }}">New</a>
            </div>
        </div>

        <div class="body">
            <table>
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product_sizes as $value)
                    <tr class="searchable">
                        <td>{{ $value->product_size }}</td>
                        <td class="actions">
                                <div class="action">
                                <a href="{{ route('productsizes.edit', ['productsize'=>$value->id]) }}">
                                    <i class="fas fa-pencil-alt update"></i>
                                </a>
                            </div>
                            
                            <div class="action">
                                <form id="deleteForm_{{ $value->id }}" action="{{ route('productsizes.destroy', ['productsize' => $value->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="deleteItem({{ $value->id }}, 'product size');">
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
