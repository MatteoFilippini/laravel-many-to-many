@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Lista Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Crea post</a>
    </div>
    @if(session('message'))
    <div class="alert alert-{{ session('type') ?? info }}">
        {{ session('message') }}
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Slug</th>
                <th scope="col">Data</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>
                    @if( $post->category)
                    {{ $post->category->label }}
                    @else -
                    @endif

                </td>
                <td>{{ $post->slug }}</td>
                <td>{{ $post->created_at }}</td>
                <td class="d-flex align-items-center">
                    <a href="{{ route('admin.posts.show',$post->id) }}" class="btn btn-primary btn-sm mr-2">Vedi</a>
                    <form action="{{ route('admin.posts.destroy',$post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm mr-2">Elimina</button>
                    </form>
                    <a href="{{ route('admin.posts.edit',$post->id) }}" class="btn btn-warning btn-sm mr-2">Modifica</a>
                </td>
            </tr>
            @empty
            <tr>
                <td collspan="4">
                    <h3>Non ci sono posts</h3>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection