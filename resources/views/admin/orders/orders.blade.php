@extends('admin.partials.base')

@section('admin_content')
    <div class="container orders">
        <div class="header">
            <h1>Orders</h1>
            @include('admin.partials.search_bar')
        </div>

        <div class="body">
            <table>
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Names</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Shipping</th>
                        <th>Amount (Ksh)</th>
                        <th>Status</th>
                        <th>Paid</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $value)
                    <tr class="searchable">
                        <td>{{ $value->order_number }}</td>
                        <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                        <td>{{ $value->phone_number }}</td>
                        <td>{{ $value->address }}</td>
                        <td>{{ number_format($value->shipping_cost) }}</td>
                        <td>{{ number_format($value->total_amount) }}</td>
                        <td class="{{ $value->status == 'pending' ? 'text-danger' : 'text-success'  }}">{{ $value->status }}</td>
                        <td>{{ $value->paid == 0 ? 'No' : 'Yes' }}</td>
                        <td class="actions">
                                <div class="action">
                                <a href="{{ route('get_update_order', ['id'=>$value->id]) }}">
                                    <i class="fas fa-pencil-alt update"></i>
                                </a>
                            </div>
                            <div class="action">
                                <form id="deleteForm_{{ $value->id }}" action="{{ route('delete_order', ['id' => $value->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <a href="javascript:void(0);" onclick="deleteItem({{ $value->id }}, 'order');">
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
