<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'meta_title' => 'required|unique:posts|min:2|max:255',
                'meta_description' => 'required|unique:posts|min:2|max:255',
                'title' => 'required|unique:posts|min:2|max:255',
                'description' => 'required|unique:posts|min:2|max:255',
                'image' => 'mimes:jpeg,jpg,png,gif|required',
                'category_id' => 'exists:categories,id',
                'tags' => 'required|array',
                'tags.*' => 'required|exists:tags,id',
            ];
        }elseif ($this->method() == 'PUT') {
            $id = $this->request->get('id');
            return [
                'meta_title' => 'required|min:2|max:255|unique:posts,meta_title,'. $id,
                'meta_description' => 'required|min:2|max:255|unique:posts,meta_description,'. $id,
                'title' => 'required|min:2|max:255|unique:posts,title,'. $id,
                'description' => 'required|min:2|max:255|unique:posts,description,'. $id,
                'image' => 'mimes:jpeg,jpg,png,gif|sometimes|required',
                'category_id' => 'exists:categories,id',
                'tags' => 'required|array',
                'tags.*' => 'required|exists:tags,id',
            ];
        }
        
    }
}
