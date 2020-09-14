@extends('admin-page.admin_home')

@section('items')
<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12 offset-0 col-md-10 offset-md-1">
            @if(session('message'))
            <div class="alert alert-success mt-3">{{ session('message') }}</div>
            @endif
            <div class="comments mb-3">
                @foreach($comments as $comment)
                <div class="card card_comment">
                    <div class="card-body">
                        <div>
                            <p class="m-0">{{ $comment->user_id ? $comment->user->full_name : 'Guest'}}: <i>{{ $comment->comment }}</i></p>
                            <p class="mb-0 mt-1"><a href="{{ route('allSubComments',$comment->id) }}">Comment</a></p>
                        </div>
                        <form action="{{ route('commentDelete',$comment->id) }}" method="post">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-danger"><i class="fa fa-remove"></i></button>
                        </form>           
                    </div>
                </div>
                @endforeach
            </div>
            {{$comments->links()}}
        </div>
    </div>
</div>
@endsection