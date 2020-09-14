@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 offset-0 col-md-8 offset-md-2">
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image" aria-describedby="inputGroupFileAddon02">Choose
                            file</label>
                    </div>
                    @if($errors->has('image'))
                    <span class="error">{{$errors->first('image')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                    @if($errors->has('meta_title'))
                    <span class="error">{{$errors->first('meta_title')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ old('meta_description') }}</textarea>
                    @if($errors->has('meta_description'))
                    <span class="error">{{$errors->first('meta_description')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    @if($errors->has('title'))
                    <span class="error">{{$errors->first('title')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                    <span class="error">{{$errors->first('description')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="category_id">Select Category</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))
                    <span class="error">{{$errors->first('category_id')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    @foreach($tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                            id="{{ $tag->title }}">
                        <label class="form-check-label" for="{{ $tag->title }}">
                            #{{ $tag->title }}
                        </label>
                        @if ($errors->has('tags'))
                        <span class="error"> {{ $errors->first('tags') }}</span>
                        @endif
                    </div>                  
                    @endforeach
                </div>
                <button class="btn btn-primary">Create Post</button>
            </form>
        </div>
    </div>
</div>
@endsection