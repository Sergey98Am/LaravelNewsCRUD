@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="{{ route('tag.store') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Create Tag"
                        aria-label="Create Tag" aria-describedby="button-addon2" name='title' value="{{ old('title') }}">
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