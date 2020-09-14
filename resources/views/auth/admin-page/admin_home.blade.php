@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2 ">
            <h2 class="text-center" style="margin-bottom: 20px"><i>Admin Page</i></h2>
            <div class="row">
                <div class="col-4">
                    <a href="{{ route('allUsers') }}" class="btn btn-success" style="width: 100%;color: white">List
                        Users</a>
                </div>
                <div class="col-4">
                    <a href="{{ route('a_post.index') }}" class="btn btn-secondary" style="width: 100%;color: white">List
                        Posts</a>
                </div>
                <div class="col-4">
                    <a href="{{ route('allComments') }}" class="btn btn-light" style="width: 100%;color: black">List
                        Comments</a>
                </div>
            </div>
        </div>
        @yield('items')
    </div>
</div>
@endsection