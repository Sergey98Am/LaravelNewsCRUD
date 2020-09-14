@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 offset-0 col-md-8 offset-md-2">
            <form action="{{route('category.update',$category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <input type="hidden" name="id" value="{{ $category->id }}">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Create Category"
                        aria-describedby="button-addon2" name='title' value="{{$category->title}}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="button-addon2">Submit</button>
                    </div>
                </div>
                @if($errors->has('title'))
                <span class="error">{{$errors->first('title')}}</span>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection