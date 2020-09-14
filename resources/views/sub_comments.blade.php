@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 offset-0 col-md-10 offset-md-1">
            <div class="card card_comment mb-3">
                <div class="card-body">
                    <div>
                        <p class="m-0">{{ $commentFindId->user_id ? $commentFindId->user->full_name : 'Guest'}}:
                            <i>{{ $commentFindId->comment }}</i></p>
                    </div>
                </div>
            </div>
            <form action="{{ route('commentCreate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $commentFindId->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user() ? Auth::user()->id : '' }}">
                <input type="hidden" name="post_id" value="{{ $commentFindId->post_id }}">
                <div class="form-group">
                    <textarea class="form-control" id="comment" name="comment" rows="3"
                        placeholder="Comment...">{{ old('comment') }}</textarea>
                    @if($errors->has('comment'))
                    <span class="error">{{$errors->first('comment')}}</span>
                    @endif
                </div>
                <button class="btn btn-primary mb-3">Create Comment</button>
            </form>
            @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="comments mb-3">
                @foreach($comments as $comment)
                <div class="card card_comment">
                    <div class="card-body">
                        <div>
                            <p class="m-0">{{ $comment->user_id ? $comment->user->full_name : 'Guest'}}:
                                <i>{{ $comment->comment }}</i></p>
                            <p class="mb-0 mt-1"><a href="{{ route('subCommentsView',$comment->id) }}">Comment</a></p>
                        </div>
                        @if(Auth::user() && Auth::user()->id == $comment->post->user_id)
                        <form action="{{ route('commentDelete',$comment->id) }}" method="post">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-danger"><i class="fa fa-remove"></i></button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            {{$comments->links()}}
        </div>
    </div>
</div>
@endsection