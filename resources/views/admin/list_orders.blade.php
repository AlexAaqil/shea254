@extends('partials.base')

@section('content')
<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Orders">
        <div class="container">
            <div class="header">
                <h1>Orders</h1>
                <input type="text" name="search" id="myInput" placeholder="Search" onkeyup="searchFunction()" />
            </div>

            @include('partials.messages')

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
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $value)
                        <tr class="searchable">
                            <td>{{ $value->order_number }}</td>
                            <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                            <td>{{ $value->phone_number }}</td>
                            <td>{{ $value->address }}</td>
                            <td>{{ $value->shipping_cost }}</td>
                            <td>{{ $value->total_amount }}</td>
                            <td>{{ $value->status }}</td>
                            <td>{{ $value->paid == 0 ? 'No' : 'Yes' }}</td>
                            <td class="actions">
                                 <div class="action">
                                    <a href="{{ route('get_update_category', ['id'=>$value->id]) }}">
                                        <i class="fas fa-pencil-alt update"></i>
                                    </a>
                                </div>
                                {{-- <div class="action">
                                    <form id="deleteForm_{{ $value->id }}" action="{{ route('delete_category', ['id' => $value->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <a href="javascript:void(0);" onclick="deleteItem({{ $value->id }}, 'category');">
                                            <i class="fas fa-trash-alt delete"></i>
                                        </a>
                                    </form>
                                </div> --}}
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
