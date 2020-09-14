@extends('admin-page.admin_home')

@section('items')
<div class="col-12">
    @if(session('message'))
    <div class="alert alert-success mt-3">{{ session('message') }}</div>
    @endif
    <div class="mt-3" style="overflow-x:auto;">
        <table class="table text-center">
            <thead>
                <tr class="bg-success">
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Age</th>
                    <th scope="col">Country</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="bg-success">
                    <td>
                        <p><a href="{{ route('userPostsAdmin',$user->id) }}"
                                style="color: white">{{ $user->full_name }}</a></p>
                    </td>
                    <td>
                        <p>{{ $user->email }}</p>
                    </td>
                    <td>
                        <p>{{ $user->age }}</p>
                    </td>
                    <td>
                        <p>{{ $user->country->name }}</p>
                    </td>
                    <td>
                        <p>{{ $user->gender }}</p>
                    </td>
                    <td>
                        <a href="{{ route('editUser',$user->id) }}" class="btn btn-light">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('deleteUser',$user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$users->links()}}
    </div>
</div>
@endsection