@extends('admin-page.admin_home')

@section('items')
<div class="col-12">
    @if(session('message'))
    <div class="alert alert-success mt-3">{{ session('message') }}</div>
    @endif
    <div class="mt-3" style="overflow-x:auto;">
        <table class="table text-center">
            <thead>
                <tr class="bg-info">
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Show</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr class="bg-info">
                    <td>{{ $post->meta_title }}</td>
                    <td>{{ $post->meta_description }}</td>
                    <td>
                        <img src="{{asset('images/'.$post->image)}}" width="60">
                    </td>
                    <td>
                        <a href="{{ route('a_post.show',$post->id) }}" class="btn btn-light">Show</a>
                    </td>
                    <td>
                        <a href="{{ route('adminComments',$post->id) }}" class="btn btn-light"><i class="fa fa-comment"></i></a>
                    </td>
                    <td>
                        <a href="{{ route('a_post.edit',$post->id) }}" class="btn btn-light">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('a_post.destroy',$post->id)}}" method="post">
                            @csrf
                            @method("DELETE")
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$posts->links()}}
    </div>
</div>
@endsection