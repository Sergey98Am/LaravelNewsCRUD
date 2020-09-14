<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function CommentsView($id)
    {
        $post = Post::find($id);
        $post1 = Post::with('comments')->find($id);
        $comment = Comment::find($id);

        return view('comments',['post' => $post,'comments' => $post1->comments()->orderBy('id','desc')->paginate(6), 'comment' => $comment]);
    }

    public function CommentCreate(CommentRequest $request)
    {
        $input = $request->except('_token');

        $validated = $request->validated();

        $comment = new Comment();
        $comment->fill($input);
        $comment->save();

        return back()->with('message','Success!');;
    }

    public function CommentDelete($id){
        $delete = Comment::find($id);
        $delete->delete();

        return back()->with('message','Success!');;
    }

    public function SubCommentsView($id){
        $comment = Comment::find($id);
        $comment1 = Comment::with('subComments')->find($id);

        return view('sub_comments',['commentFindId' => $comment,'comments' => $comment1->subComments()->orderBy('id','desc')->paginate(6)]);
    }
}
