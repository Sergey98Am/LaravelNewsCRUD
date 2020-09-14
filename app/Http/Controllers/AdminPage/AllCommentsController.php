<?php

namespace App\Http\Controllers\AdminPage;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class AllCommentsController extends Controller
{
    public function index(){
        $comments = Comment::OrderBy('id','desc')->where('parent_id',null)->paginate(6);
        
        return view('admin-page.all_comments',compact('comments'));
    }

    public function AllSubComments($id){
        $comment = Comment::find($id);
        $comment1 = Comment::with('subComments')->find($id);

        return view('admin-page.all_sub_comments',['commentFindId' => $comment,'comments' => $comment1->subComments()->orderBy('id','desc')->paginate(6)]);
    }

    public function DeleteComment($id){
        $delete = Comment::find($id);
        $delete->delete();
        
        return back()->with('message','Success!');
    }
}
