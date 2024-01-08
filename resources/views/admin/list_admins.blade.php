@extends('partials.base')

@section('content')
<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Admins">
        <div class="container">
            <div class="header"> 
                <h1>Admins</h1>
                <input type="text" name="search" id="search" placeholder="Search">
            </div>

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
                        @foreach($list_admins as $admin)
                        <tr>
                            <td>{{ $admin->first_name }} {{ $admin->last_name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone_number }}</td>
                            <td>{{ $admin->user_level === 1? 'Admin':'User' }} </td>
                            <td>{{ $admin->status === 1? 'Active':'Inactive' }} </td>
                            <td class="actions">
                                <div class="action">
                                    <a href="{{ route('get_update_admin', ['id' => $admin->id]) }}">
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
    </section>
</main>
@include('partials.javascripts')
@endsection
