<?php

namespace App\Http\Controllers\Auth\AdminPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\AllUsersRequest;
use App\Models\User;
use App\Models\Country;

class AllUsersController extends Controller
{
    public function index(){
        $users = User::OrderBy('id','desc')->paginate(6);

        return view('auth.admin-page.all_users',compact('users'));
    }

    public function edit($id){
        $user = User::find($id);
        $countries = Country::all();

        return view('auth.admin-page.edit_user',compact('user','countries'));
    }

    public function update($id, AllUsersRequest $request){
        $input = $request->except('_token','_method','id');

        $validated = $request->validated();
        
        $user = User::find($id);
        $user->fill($input);
        $user->update();

        return redirect()->route('allUsers')->with('message','Success!');
    }
    
    public function delete($id)
    {
        $delete = User::find($id);
        $delete->delete();

        return redirect()->route('allUsers')->with('message','Success!');
    }
}
