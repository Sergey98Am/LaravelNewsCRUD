<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::with('posts')->find($user_id);
        return view('auth.post',['posts' => $user->posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('auth.post_create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token','image');
        $post = new Post;
        $validator = Validator::make($request->all(),[
            'meta_title' => 'required|unique:posts|min:2|max:255',
            'meta_description' => 'required|unique:posts|min:2|max:255',
            'title' => 'required|unique:posts|min:2|max:255',
            'description' => 'required|unique:posts|min:2|max:255',
            'image' => 'mimes:jpeg,jpg,png,gif|required',
            'category_id' => 'exists:categories,id'
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
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

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $tags = $post->tags;
        return view('auth.post_show',compact('post','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = Post::find($id);
        return view('auth.post_edit',compact('categories','tags','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $input = $request->except('_token','_method','image');
        $validator = Validator::make($request->all(),[
            'meta_title' => 'required|min:2|max:255|unique:posts,meta_title,'. $post->id,
            'meta_description' => 'required|min:2|max:255|unique:posts,meta_description,'. $post->id,
            'title' => 'required|min:2|max:255|unique:posts,title,'. $post->id,
            'description' => 'required|min:2|max:255|unique:posts,description,'. $post->id,
            'image' => 'mimes:jpeg,jpg,png,gif|sometimes|required',
            'category_id' => 'exists:categories,id'

        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $file_name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$file_name);
            $post->image = $file_name;
        }
        
        $post->fill($input);
        $post->update();

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Post::find($id);
        
        \File::delete(public_path().'/images/'.$destroy->image);
         
        $destroy->tags()->detach();
        $destroy->delete();
        return redirect()->route('post.index');
    }

    public function categoryPostsAdmin($id){
        $category = Category::with('posts')->find($id);
        return view('auth.post',['posts' => $category->posts]);

    }

    public function tagPostsAdmin($id){
        $tag = Tag::with('posts')->find($id);
        return view('auth.post',['posts' => $tag->posts]);
    }
}
