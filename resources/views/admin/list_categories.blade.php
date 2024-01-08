@extends('partials.base')

@section('content')
<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Categories">
        <div class="container">
            <div class="header">
                <h1>Categories</h1>
                <input type="text" name="search" id="search" placeholder="Search">
                <div class="header_btn">
                    <a href="{{ route('add_category') }}">New</a>
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
                        <tr>
                            <td>Category Title</td>
                            <td>Slug</td>
                            <td class="actions">
                                <div class="action">
                                    <a href="#">
                                        <i class="fas fa-pencil-alt update"></i>
                                    </a>
                                </div>
                                <div class="action">
                                    <a href="#">
                                        <i class="fas fa-trash delete"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
@include('partials.javascripts')
@endsection
