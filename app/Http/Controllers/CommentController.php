<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public static function getComments(){
        $comments = Comment::select('comments.*','blog_users.username','blog_users.img')
        ->join('blog_users','comments.user_id','=','blog_users.user_id')->orderBy('comments.created_at','desc')->get();
        return $comments;
    }
    public function addComment(CreateCommentRequest $request){
        try{
            $comment = new Comment([
                'comment_content' =>$request->input('comment_content'),
                'post_id' => $request->input('post_id'),
                'user_id' => $request->input('user_id')
            ]);
            $comment->save();
            return redirect()->route('blogUser.blog');
        }catch(\Exeption $e){
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error occurred while adding user']);
        }
    }
    public function deleteComment($comment_id){
        $comment = Comment::find($comment_id);
        $comment->delete();
        return redirect()->route('blogUser.post_editor');
    }
    public function acceptComment($comment_id){
        $comment = Comment::find($comment_id);
        $comment->update(['accepted' => 1]);
        return redirect()->route('blogUser.post_editor');
    }
}