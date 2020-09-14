<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use Auth;
use App\Models\User;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('id','desc')->paginate(6);

        return view('tag',compact('tags'));
    }

    public function create()
    {
        return view('tag_create');
    }

    public function store(TagRequest $request)
    {
        $tag = new Tag();

        $input = $request->except('_token');

        $validated = $request->validated();

        $tag->fill($input);
        $tag->save();

        return redirect()->route('tag.index')->with('message','Success!');;
    }

    public function edit($id)
    {
        $tag = Tag::find($id);

        return view('tag_edit',compact('tag'));
    }

    public function update(TagRequest $request, $id)
    {
        $tag = Tag::find($id);

        $input = $request->except('_token','_method','id');
    
        $validated = $request->validated();    
        $tag->fill($input);
        $tag->update();

        return redirect()->route('tag.index')->with('message','Success!');;
    }

    public function destroy($id)
    {
        $destroy = Tag::find($id);
        $destroy->delete();

        return redirect()->route('tag.index')->with('message','Success!');
    }
}
