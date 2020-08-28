<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
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
        $posts = Post::all();
        return view('auth.post',compact('posts'));
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
        $input = $request->except('_token');
        $validator = Validator::make($input,[
            'meta_title' => 'required',
            'meta_description' => 'required',
            'title' => 'required',
            'description' => 'required',
            'images' => 'required',
            'category_id' => 'required',
            'tags' => 'required',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        if ($request->hasFile('images')){
            $files = $request->file('images');
            $image = [];
            foreach ($files as $file){
                $file_name = time().$file->getClientOriginalName();
                array_push($image,$file_name);
                $file->move(public_path().'/images/',$file_name);
            }
            $input['images'] = json_encode($image);
        }else{
            return redirect()->route('post.create');
        }

        $tags = $request->tags;
        $input['tags'] = json_encode($tags);

        $post = new Post;
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
        $tags = Tag::all();
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
        $input = $request->except('_token','_method','tags');
        $validator = Validator::make($input,[
            'meta_title' => 'required',
            'meta_description' => 'required',
            'title' => 'required',
            'description' => 'required',
            'images' => 'sometimes|required',
            'category_id' => 'required',

        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        if ($request->hasFile('images')){
            $files = $request->file('images');
            $image = [];
            foreach ($files as $file){
                $file_name = time().$file->getClientOriginalName();
                array_push($image,$file_name);
                $file->move(public_path().'/images/',$file_name);

            }
            $input['images'] = json_encode($image);
        }else{
            $input['images'] = $post->images;
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
        foreach (json_decode($destroy->images) as $img){
            \File::delete(public_path().'/images/'.$img);
        }
 
        $destroy->tags()->detach();
        $destroy->delete();
        return redirect()->route('post.index');
    }

    public function categoryPostsAdmin($id){
        $posts = Post::where('category_id',$id)->get();
        return view('auth.post',compact('posts'));
    }

    public function tagPostsAdmin($id){
        $tag = Tag::find($id);
        $posts = $tag->posts;

        return view('auth.post',compact('tag','posts'));
    }
}
