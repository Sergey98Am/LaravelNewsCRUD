<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
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
