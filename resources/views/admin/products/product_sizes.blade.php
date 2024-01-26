@extends('admin.partials.base')
@section('admin_content')
    <div class="container product_sizes">
        @include('admin.products.products_navbar')
        
        <div class="header">
            <h1>Product Sizes</h1>
            <input type="text" name="search" id="myInput" placeholder="Search" onkeyup="searchFunction()" />
            <div class="header_btn">
                <a href="{{ route('get_add_product_size') }}">New</a>
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
                                <a href="{{ route('get_update_product_size', ['id'=>$value->id]) }}">
                                    <i class="fas fa-pencil-alt update"></i>
                                </a>
                            </div>
                            <div class="action">
                                <form id="deleteForm_{{ $value->id }}" action="{{ route('delete_product_size', ['id' => $value->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <a href="javascript:void(0);" onclick="deleteItem({{ $value->id }}, 'product size');">
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
@endsection
