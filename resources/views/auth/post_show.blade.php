@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card mb-3" style="max-width: 100%;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        @foreach(json_decode($post->images) as $img)
                        <img src="{{asset('images/'.$img)}}" class="card-img" alt="..." style="object-fit: cover">
                        @endforeach
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{$post->description}}</p>
                            @foreach($tags as $tag)
                            @foreach(json_decode($post->tags) as $post_tag)
                            @if($tag->id == $post_tag)
                            <a style="color: blue; margin-right: 3px; cursor: pointer" href="{{ route('tagPostsAdmin',$tag->id) }}">#{{ $tag->title }}</a>
                            @endif
                            @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection