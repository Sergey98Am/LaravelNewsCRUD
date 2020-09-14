@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="{{route('category.create')}}" class="btn btn-success mb-3"><i class="fa fa-plus"></i> Create
                Category</a>
            @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div style="overflow-x:auto;">
                <table class="table text-center">
                    <thead>
                        <tr class="bg-primary">
                            <th scope="col">Title</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr class="bg-primary">
                            <td>
                                <p>{{ $category->title }}</p>
                            </td>
                            <td>
                                <a href="{{ route('category.edit',$category->id) }}" class="btn btn-light">Edit</a>
                            </td>
                            <td>
                                <form action="{{route('category.destroy',$category->id)}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$categories->links()}}
            </div>
        </div>
    </div>
</div>
@endsection