<?php

namespace App\Http\Controllers;

use App\Posts;
use App\Category;
use App\Tags;
use Illuminate\Http\Request;
use Validator;
use Auth;

class FrontController extends Controller
{
    function index(){
        $categories = Category::all();
        $posts = Posts::all();
        $tags = Tags::all();
        return view('welcome',compact('categories','posts','tags'));
    }

    function categoryPosts($id){
        $posts = Posts::where('category_id',$id)->get();
        return view('posts_front',compact('posts'));
    }

    function viewPost($id){
        $post = Posts::find($id);
        $tags = Tags::all();
        return view('post_view',compact('post','tags'));
    }

    function tagPosts($id){
        $tag = Tags::find($id);
        $posts = $tag->posts;

        return view('posts_front',compact('tag','posts'));
    }
}
