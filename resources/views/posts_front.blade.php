@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h5 style="margin-bottom: 20px"><i>Posts</i></h5>
        </div>
        @foreach($posts as $post)
        <div class="col-12 col-sm-6 col-lg-4 mb-5">
            <div class="card news_card" style="width: 100%;">
                <img class="card-img-top" src="{{asset('images/'.$post->image)}}" width="60">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->meta_title }}</h5>
                    <p class="card-text">{{ $post->meta_description }}</p>
                    <a href="{{ route('viewPost',$post->id) }}" class="btn btn-primary">View</a>
                    <a href="{{ route('commentsView',$post->id) }}" class="btn btn-dark mt-2"><i
                            class="fa fa-comment"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection