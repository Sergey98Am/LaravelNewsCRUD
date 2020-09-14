<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

class FrontController extends Controller
{
    function index(){
        $categories = Category::all();

        return view('welcome',compact('categories'));
    }

    function categoryPosts($id){
        $category = Category::with('posts')->find($id);

        return view('posts_front',['posts' => $category->posts]);
    }

    function viewPost($id){
        $post = Post::find($id);

        return view('post_view',compact('post'));
    }

    function tagPosts($id){
        $tag = Tag::with('posts')->find($id);

        return view('posts_front',['posts' => $tag->posts]);
    }

    function MyPosts(){
        $user = User::with('posts')->find(Auth::user()->id);

        return view('posts_front',['posts' => $user->posts]);
    }
}
