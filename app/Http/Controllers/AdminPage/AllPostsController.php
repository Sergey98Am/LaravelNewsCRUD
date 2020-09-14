<?php

namespace App\Http\Controllers\AdminPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

class AllPostsController extends Controller
{
    public function index(){
        $posts = Post::OrderBy('id','desc')->paginate(6);

        return view('admin-page.all_posts',compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        $tags = $post->tags;

        return view('admin-page.show_post',compact('post','tags'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = Post::find($id);

        return view('admin-page.edit_post',compact('categories','tags','post'));
    }

    public function update($id, PostRequest $request){
        $post = Post::find($id); 

        if ($request->hasFile('image')){
            $file = $request->file('image');
            $file_name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$file_name);
            $post->image = $file_name;
        }

        $input = $request->except('_token','_method','image','id');

        $validated = $request->validated();  

        $post->fill($input);
        $post->update();
        $post->tags()->sync($request->tags);

        return redirect()->route('a_post.index')->with('message','Success!');;
    }

    public function destroy($id)
    {
        $destroy = Post::find($id);
        \File::delete(public_path().'/images/'.$destroy->image);
        $destroy->delete();

        return redirect()->route('a_post.index')->with('message','Success!');;
    }

    public function TagPostsAdmin($id){
        $tag = Tag::with('posts')->find($id);

        return view('admin-page.all_posts',['posts' => $tag->posts()->paginate(6)]);
    }

    public function UserPostsAdmin($id){
        $category = User::with('posts')->find($id);

        return view('admin-page.all_posts',['posts' => $category->posts()->paginate(6)]);
    }
}
