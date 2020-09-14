@extends('auth.admin-page.admin_home')

@section('items')
<div class="container mt-3">
    <div class="row">
        <div class="col-sm-12 offset-0 col-md-8 offset-md-2">
            <h3>Edit</h3>
            <form action="{{route('updateUser',$user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <label for=""></label>
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                    @if($errors->has('first_name'))
                    <span class="error">{{$errors->first('first_name')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                    @if($errors->has('last_name'))
                    <span class="error">{{$errors->first('last_name')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    @if($errors->has('email'))
                    <span class="error">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Date Of Birth</label>
                    <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $user->date_of_birth }}">
                    @if($errors->has('date_of_birth'))
                    <span class="error">{{$errors->first('date_of_birth')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="country">Select Country</label>
                    <select class="form-control" id="country_id" name="country_id">
                        <option value="">Select Category</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ $country->id == $user->country_id ? 'selected' : ''}} >{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('country_id'))
                    <span class="error">{{$errors->first('country_id')}}</span>
                    @endif
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection