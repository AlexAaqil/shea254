@extends('admin.partials.base')
@section('admin_content')
    <div class="container comments">
        <div class="header">
            <h1>Comments</h1>
            <input type="text" name="search" id="myInput" placeholder="Search" onkeyup="searchFunction()" />
        </div>

        <div class="body">
            <table>
                <thead>
                    <tr>
                        <th>Names</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $value)
                    <tr class="searchable">
                        <td>{{ $value->full_name }}</td>
                        <td>{{ $value->email_address }}</td>
                        <td>{{ $value->phone_number }}</td>
                        <td>{{ Illuminate\Support\Str::limit($value->message, 40) }}</td>
                        <td class="actions">
                                <div class="action">
                                <a href="{{ route('comments.show', ['comment'=>$value->id]) }}">
                                    <i class="fas fa-eye update"></i>
                                </a>
                            </div>
                            <div class="action">
                                <form id="deleteForm_{{ $value->id }}" action="{{ route('comments.destroy', ['comment' => $value->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="deleteItem({{ $value->id }}, 'comment');">
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
