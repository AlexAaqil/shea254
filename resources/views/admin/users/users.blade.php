@extends('admin.partials.base')
@section('admin_content')
    <div class="container users">
        <div class="header">
            <h1>Users</h1>
            <input type="text" name="search" id="search" placeholder="Search">
        </div>

        @include('partials.messages')

        <div class="body">
            <table>
                <thead>
                    <tr>
                        <th>Names</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>User Level</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list_users as $user)
                    <tr>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->User_level == 1 ? 'Admin':'User' }}</td>
                        <td class="{{ $user->status == 1 ? '' : 'text-danger bold' }}">{{ $user->status == 1 ? 'Active' : 'Inactive'}} </td>
                        <td class="actions">
                            <div class="action">
                                <a href="{{ route('get_update_user', ['id' => $user->id]) }}">
                                    <i class="fas fa-pencil-alt update"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
