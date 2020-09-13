@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-8 offset-2">
        <div class="card text-white bg-primary mb-3" style="max-width: 100%">
            <div class="card-header">
                <h4>Profile Page</h4>
            </div>
            <div class="card-body">
            <form action="{{route('updateProfile')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <label for=""></label>
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                        value="{{ Auth::user()->first_name }}">
                    @if($errors->has('first_name'))
                    <span class="error">{{$errors->first('first_name')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name"
                        value="{{ Auth::user()->last_name }}">
                    @if($errors->has('last_name'))
                    <span class="error">{{$errors->first('last_name')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                    @if($errors->has('email'))
                    <span class="error">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Date Of Birth</label>
                    <input type="text" class="form-control" id="date_of_birth" name="date_of_birth"
                        value="{{ Auth::user()->date_of_birth }}">
                    @if($errors->has('date_of_birth'))
                    <span class="error">{{$errors->first('date_of_birth')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="country">Select Country</label>
                    <select class="form-control" id="country_id" name="country_id">
                        <option value="">Select Category</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}"
                            {{ $country->id == Auth::user()->country_id ? 'selected' : ''}}>{{ $country->name }}
                        </option>
                        @endforeach
                    </select>
                    @if($errors->has('country_id'))
                    <span class="error">{{$errors->first('country_id')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password">

                    @if($errors->has('password'))
                    <span class="error">{{$errors->first('password')}}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>
                <button class="btn btn-light">Update</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection