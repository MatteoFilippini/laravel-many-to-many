@extends ('layouts.app')

@section('content')
<div class="container">
    @if(session('message'))
    <div class="alert alert-{{ session('type') ?? info}}">
        {{session('message')}}
    </div>
    @endif
    <div class="card">
        <h5 class="card-header">{{ $post->title }}</h5>
        <div class="card-body">
            <h5 class="card-title">{{$post->slug}}</h5>
            <p class="card-text">{{ $post->content }}</p>
            <figure>
                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid" width="250px">
            </figure>
            <a href="{{route('admin.posts.index')}}" class="btn btn-secondary btn-sm">Indietro</a>
        </div>
    </div>
</div>
@endsection