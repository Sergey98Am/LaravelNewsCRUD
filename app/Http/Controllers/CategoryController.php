<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::OrderBy('id','desc')->paginate(6);

        return view('category', compact('categories'));
    }

    public function create()
    {
        return view('category_create');
    }

    public function store(CategoryRequest $request)
    {
        $input = $request->except('_token');

        $validated = $request->validated();

        $category = new Category();
        $category->fill($input);
        $category->save();

        return redirect()->route('category.index')->with('message','Success!');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('category_edit',compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $input = $request->except('_token','_method','id');

        $validated = $request->validated();

        $category = Category::find($id);
        $category->fill($input);
        $category->update();

        return redirect()->route('category.index')->with('message','Success!');
    }

    public function destroy($id)
    {
        $destroy = Category::find($id);
        $destroy->delete();

        return redirect()->route('category.index')->with('message','Success!');
    }
}
