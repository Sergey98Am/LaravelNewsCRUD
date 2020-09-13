@extends('layouts.app')

@section('content')
<div class="container">
 
    <div class="row">
        <div class="col-8 offset-2 ">
            <h2 class="text-center" style="margin-bottom: 20px"><i>Admin Page</i></h2>
            <div class="row">
                <div class="col-4">
                    <a class="btn btn-primary" style="width: 100%;color: white" href="{{ route('allUsers') }}">List
                        Users</a>
                </div>
                <div class="col-4">
                    <a class="btn btn-info" style="width: 100%;color: white" href="{{ route('a_post.index') }}">List
                        Posts</a>
                </div>
                <div class="col-4">
                    <a class="btn btn-dark" style="width: 100%;color: white" href="{{ route('allComments') }}">List
                        Comments</a>
                </div>
            </div>
        </div>
        @yield('items')

    </div>
</div>
@endsection