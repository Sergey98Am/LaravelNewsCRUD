@extends('auth.admin-page.admin_home')

@section('items')
<div class="container mt-4">
    <div class="row">
        <div class="col-10 offset-1">
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
                            <a style="color: blue; margin-right: 3px; cursor: pointer" href="{{ route('tagPostsAdmin',$tag->id) }}">#{{ $tag->title }}</a>     
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection