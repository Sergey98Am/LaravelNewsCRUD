<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthUserRequest;
use Auth;

class UserController extends Controller
{
    public function update(AuthUserRequest $request)
    {
        $input = $request->except('password', 'password_confirmation');

        $validated = $request->validated();

        $user = Auth::user();
        if (!$request->filled('password')) {
            $user->fill($input)->save();

            return back()->with('message','Success!');
        }

        $user->password = bcrypt($request->password);
        $user->fill($input)->save();

        return back()->with('message','Success!');
    }
}
