@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="{{route('post.create')}}" class="btn btn-success mb-3"><i class="fa fa-plus"></i> Create Post</a>
            <div style="overflow-x:auto;">
                <table class="table text-center">
                    <thead>
                        <tr class="bg-primary">
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image(s)</th>
                            <th scope="col">Show</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($posts as $post)

                        <tr class="bg-primary">
                            <td>{{ $post->meta_title }}</td>
                            <td>{{ $post->meta_description }}</td>
                            <td>
                                @foreach(json_decode($post->images) as $img)
                                <img src="{{asset('images/'.$img)}}" width="60">
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('post.show',$post->id) }}" class="btn btn-light">Show</a>
                            </td>
                            @if($post->user_id == Auth::user()->id)

                            <td>
                                <a href="{{ route('post.edit',$post->id) }}" class="btn btn-light">Edit</a>
                            </td>
                            <td>
                                <form action="{{route('post.destroy',$post->id)}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </td>
                            @else
                            <td><span style="font-size: 22px"><i class="fa fa-times-circle"></i></span></td>
                            <td><span style="font-size: 22px; color:red"><i class="fa fa-times-circle"></i></span></td>

                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection