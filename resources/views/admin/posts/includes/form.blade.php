@extends('layouts.app')

@section('content')
<div class="container">
    @if($post->exists)
    <form action="{{ route('admin.posts.update',$post->id) }}" method="POST" novalidate>
        @method('PUT')
        <h1>Modifica post</h1>
        @else
        <form action="{{ route('admin.posts.store') }}" method="POST">
            <h1>Crea post</h1>
            @endif
            @csrf
            <div class="form-group">
                <label for="exampleTitle">Titolo</label>
                <input type="text" class="form-control" id="exampleTitle" name="title" value="{{ old('title', $post->title) }}">
            </div>
            <div class="form-group">
                <label for="exampleContent">Descrizione</label>
                <textarea name="content" id="content" cols="30" rows="5" class="form-control">{{ old('content', $post->content) }}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleImage">Immagine</label>
                <input type="text" class="form-control" id="exampleImage" name="image" value="{{ old('image', $post->image) }}">
            </div>
            <!-- categorie -->
            <div class="form-group">
                <label for="exampleFormControlSelect1">Categoria</label>
                <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                    <option value="">-</option>
                    @foreach ($categories as $category)
                    <option @if(old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                        {{ $category->label }}
                    </option>

                    @endforeach
                </select>
            </div>
            <button type=" submit" class="btn btn-primary">Conferma</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            <a href="{{route('admin.posts.index')}}">Indietro</a>
        </form>
</div>
@endsection