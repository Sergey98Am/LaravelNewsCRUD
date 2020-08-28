@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 offset-0 col-md-8 offset-md-2">
            <form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="images[]" name="images[]" multiple>
                        <label class="custom-file-label" for="images[]" aria-describedby="inputGroupFileAddon02">Choose
                            file</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                        value="{{ $post->meta_title }}">
                    @if($errors->has('meta_title'))
                    <span class="error">{{$errors->first('meta_title')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea class="form-control" id="meta_description" name="meta_description"
                        rows="2">{{ $post->meta_description }}</textarea>
                    @if($errors->has('meta_description'))
                    <span class="error">{{$errors->first('meta_description')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                    @if($errors->has('title'))
                    <span class="error">{{$errors->first('title')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"
                        rows="3">{{ $post->description }}</textarea>
                    @if($errors->has('description'))
                    <span class="error">{{$errors->first('description')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="category_id">Select Category</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        @if($category->id == $post->category_id)
                        <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                        @else
                        <option value="{{ $category->id }}">{{ $category->title }}</option>

                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))
                    <span class="error">{{$errors->first('category_id')}}</span>
                    @endif
                </div>
                <input type="hidden" name="tags">
                <button class="btn btn-primary">Update Post</button>
            </form>
        </div>
    </div>
</div>
@endsection