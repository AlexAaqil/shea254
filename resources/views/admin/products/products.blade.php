@extends('admin.partials.base')
@section('admin_content')
    <div class="container products">
        @include('admin.products.products_navbar')

        <div class="header">
            <h1>Products</h1>
            <input type="text" name="search" id="myInput" placeholder="Search" onkeyup="searchFunction()" />
            <div class="header_btn">
                <a href="{{ route('get_add_product') }}">New</a>
            </div>
        </div>

        <div class="body">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>In Stock</th>
                        <th>Featured</th>
                        <th>Category</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Discount Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $value)
                    <tr class="searchable">
                        <td>{{ $value->title }}</td>
                        <td>{{ $value->getTranslatedInStock() }}</td>
                        <td>{{ $value->getTranslatedFeatured() }}</td>
                        <td>{{ $value->category->title }}</td>
                        <td>{{ $value->product_size->product_size }}</td>
                        <td>{{ $value->price }}</td>
                        <td>{{ $value->discount_price ? $value->discount_price : 'No Discount' }}</td>
                        <td class="actions">
                                <div class="action">
                                <a href="{{ route('get_update_product', ['id'=>$value->id]) }}">
                                    <i class="fas fa-pencil-alt update"></i>
                                </a>
                            </div>
                            <div class="action">
                                <form id="deleteForm_{{ $value->id }}" action="{{ route('delete_product', ['id' => $value->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <a href="javascript:void(0);" onclick="deleteItem({{ $value->id }}, 'product');">
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
