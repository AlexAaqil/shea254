@extends('admin.partials.base')
@section('admin_content')
    <div class="container Blogs">
        <div class="header">
            <h1>Blogs</h1>
            @include('admin.partials.search_bar')
            <div class="header_btn">
                <a href="{{ route('blogs.create') }}">New</a>
            </div>
        </div>

        <div class="body">
            <div class="blogs">
                @foreach($blogs as $blog)
                <div class="blog searchable">
                    <div class="image">
                        <a href="{{ route('blogs.edit', ['blog' => $blog->id]) }}" class="title">
                            <img src="{{ $blog->getImageUrl() }}" alt="Blog Image">
                        </a>
                    </div>

                    <div class="text">
                        <div class="details">
                            <span class="title">
                                <a href="{{ route('blogs.edit', ['blog' => $blog->id]) }}">
                                    {{ $blog->title }}
                                </a>
                            </span>
                            <span class="content">
                                {!! html_entity_decode(Illuminate\Support\Str::limit($blog->content, 60, ' ...')) !!}
                            </span>
                        </div>

                        <div class="actions">
                            <div class="action">
                                <form id="deleteForm_{{ $blog->id }}" action="{{ route('blogs.destroy', ['blog' => $blog->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <a href="javascript:void(0);" onclick="deleteItem({{ $blog->id }}, 'blog');">
                                        <i class="fas fa-trash-alt delete"></i>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
