@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       <div class="col-12">
            <h5 style="margin-bottom: 20px"><i>Posts</i></h5>
        </div>
        @foreach($posts as $post)
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card" style="width: 100%;">
                @foreach(json_decode($post->images) as $img)
                <img class="card-img-top"  src="{{asset('images/'.$img)}}" width="60">
                @endforeach

                <div class="card-body">
                  <h5 class="card-title">{{ $post->meta_title }}</h5>
                  <p class="card-text">{{ $post->meta_description }}</p>
                  <a href="{{ route('viewPost',$post->id) }}" class="btn btn-primary">View</a>
                </div>
              </div>
        </div>
        @endforeach
    </div>
</div>
@endsection