@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Auth::user())
        <div class="col-6 offset-3">
            <a href="{{ route('myPosts') }}" style="width: 100%" type="button" class="btn btn-light">My Posts</a>
        </div>
        @endif
        <div class="col-12">
            <h5 style="margin-bottom: 20px"><i>Categories</i></h5>
        </div>
        @foreach($categories as $category)
        <div class="col-6 col-lg-4">
            <a href="{{ route('categoryPosts',$category->id) }}" style="width: 100%" type="button"
                class="btn btn-light">{{ $category->title }}</a>
        </div>
        @endforeach
    </div>
</div>
@endsection