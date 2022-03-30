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
            <!-- messaggio errori -->
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-group">
                <label for="exampleTitle">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="exampleTitle" name="title" value="{{ old('title', $post->title) }}">
                @error('title')
                <div class="invalid-feedback">
                    Please provide a valid title.
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleContent">Descrizione</label>
                <textarea name="content" id="content" cols="30" rows="5" class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
                @error('content')
                <div class="invalid-feedback">
                    Please provide a valid content.
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleImage">Immagine</label>
                <input type="text" class="form-control" id="exampleImage" name="image" value="{{ old('image', $post->image) }}">
            </div>
            <!-- categorie -->
            <div class="form-group">
                <label for="exampleFormControlSelect1">Categoria</label>
                <select class="form-control @error('category_id') is-invalid @enderror" id="exampleFormControlSelect1" name="category_id">
                    <option value="">-</option>
                    @foreach ($categories as $category)
                    <option @if(old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                        {{ $category->label }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">
                    Please provide a valid category.
                </div>
                @enderror
            </div>
            <!-- tags -->
            <div class="form-group form-check @error('tags') is-invalid @enderror">
                @foreach ($tags as $tag)
                <label class="form-check-label mr-5">
                    <input class="form-check-input mr-1" type="checkbox" value="{{$tag->id}}" name="tags[]" @if (in_array($tag->id,old('tags',$post_tag_ids ?? []))) checked @endif>{{$tag->name}}
                </label>
                @endforeach
            </div>
            @error('tags')
            <div class="invalid-feedback mb-5">
                Please provide a valid tags.
            </div>
            @enderror

            <button type=" submit" class="btn btn-primary">Conferma</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            <a href="{{route('admin.posts.index')}}">Indietro</a>
        </form>
</div>
@endsection