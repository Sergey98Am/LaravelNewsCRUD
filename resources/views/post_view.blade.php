@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <h5 style="margin-bottom: 20px"><i>Post</i></h5>
            <div class="card mb-3" style="max-width: 100%;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{asset('images/'.$post->image)}}" class="card-img" alt="..." style="object-fit: cover">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{$post->description}}</p>
                            @foreach($post->tags as $tag)
                            <a style="color: blue; margin-right: 3px; cursor: pointer" href="{{ route('tagPosts',$tag->id) }}">#{{ $tag->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection