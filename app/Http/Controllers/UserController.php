<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\AuthUserRequest;

class UserController extends Controller
{
    public function update(AuthUserRequest $request)
    {

        $validated = $request->validated();
        $input = $request->except('password', 'password_confirmation');
        $user = Auth::user();

        if (! $request->filled('password')) {
            $user->fill($input)->save();

            return back();
        }

        $user->password = bcrypt($request->password);
        $user->fill($input)->save();

        return back();
    }
}
