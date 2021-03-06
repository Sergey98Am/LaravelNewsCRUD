<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
        if($this->method() == 'POST'){
            return [
                'title' => 'required|min:2|max:255|unique:tags,title,'
            ];
        }elseif ($this->method() == 'PUT') {
            $id = $this->request->get('id');
            return [
                'title' => 'required|min:2|max:255|unique:tags,title,'.$id
            ];
        }
        
    }
}
