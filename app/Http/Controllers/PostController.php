<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::with('posts')->find($user_id);

        return view('post',['posts' => $user->posts()->orderBy('id','desc')->paginate(6)]);
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('post_create',compact('categories','tags'));
    }

    public function store(PostRequest $request)
    {
        $post = new Post;

        $input = $request->except('_token','image');

        $validated = $request->validated();   
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $file_name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$file_name);
            $post->image = $file_name;
        }else{
            return redirect()->route('post.create');
        }

        $post->fill($input);
        $post->save();

        $post->tags()->attach($request->tags);

        return redirect()->route('post.index')->with('message','Success!');;
    }

    public function show($id)
    {
        $post = Post::find($id);
        $tags = $post->tags;

        return view('post_show',compact('post','tags'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = Post::find($id);

        return view('post_edit',compact('categories','tags','post'));
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);

        $input = $request->except('_token','_method','image','id');

        $validated = $request->validated();  

        if ($request->hasFile('image')){
            $file = $request->file('image');
            $file_name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$file_name);
            $post->image = $file_name;
        }
        
        $post->fill($input);
        $post->update();
        $post->tags()->sync($request->tags);

        return redirect()->route('post.index')->with('message','Success!');
    }

    public function destroy($id)
    {
        $destroy = Post::find($id);
        \File::delete(public_path().'/images/'.$destroy->image);
        $destroy->delete();

        return redirect()->route('post.index')->with('message','Success!');
    }
}
