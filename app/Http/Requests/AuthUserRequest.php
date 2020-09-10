<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class AuthUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|min:2|max:255',
            'last_name' => 'required|min:2|max:255|',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id,
            'date_of_birth' => 'required',
            'country_id' => 'exists:countries,id',
            'password' => 'sometimes|nullable|string|min:8|confirmed',
        ];
    }
}
