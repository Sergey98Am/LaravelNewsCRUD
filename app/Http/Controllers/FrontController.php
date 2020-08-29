<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Validator;
use Auth;

class FrontController extends Controller
{
    function index(){
        $categories = Category::all();
        $posts = Post::all();
        $tags = Tag::all();
        return view('welcome',compact('categories','posts','tags'));
    }

    function categoryPosts($id){
        $posts = Post::where('category_id',$id)->get();
        return view('posts_front',compact('posts'));
    }

    function viewPost($id){
        $post = Post::find($id);
        $tags = $post->tags;
        return view('post_view',compact('post','tags'));
    }

    function tagPosts($id){
        $tag = Tag::find($id);
        $posts = $tag->posts;

        return view('posts_front',compact('tag','posts'));
    }
}
