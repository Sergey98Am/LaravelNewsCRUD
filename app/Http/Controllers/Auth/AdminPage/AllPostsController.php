<?php

namespace App\Http\Controllers\Auth\AdminPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Http\Requests\PostRequest;

class AllPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $posts = Post::OrderBy('id','desc')->paginate(6);
        return view('auth.admin-page.all_posts',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $tags = $post->tags;
        return view('auth.admin-page.show_post',compact('post','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = Post::find($id);
        return view('auth.admin-page.edit_post',compact('categories','tags','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, PostRequest $request){
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


        return redirect()->route('a_post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Post::find($id);
        
        \File::delete(public_path().'/images/'.$destroy->image);
     
        $destroy->delete();
        return redirect()->route('a_post.index');

    }

    public function TagPostsAdmin($id){
        $tag = Tag::with('posts')->find($id);
        return view('auth.admin-page.all_posts',['posts' => $tag->posts()->paginate(6)]);
    }

    public function UserPostsAdmin($id){
        $category = User::with('posts')->find($id);
        return view('auth.admin-page.all_posts',['posts' => $category->posts()->paginate(6)]);
    }
}
