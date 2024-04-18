<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public static function getPosts(){
        $posts = Post::select('posts.*','blog_users.username','blog_users.user_id','blog_users.img')->join('blog_users','blog_users.user_id','=','posts.user_id')->orderBy('posts.created_at','desc')->get();
        return $posts;
    }
    public function realPosts(){
        $posts = Post::select('posts.*','blog_users.username','blog_users.user_id','blog_users.img')->join('blog_users','blog_users.user_id','=','posts.user_id')->orderBy('posts.created_at','desc')->get();
        return view('blogUser.post_editor', ['posts'=>$posts]);
    }
    public function addPost(CreatePostRequest $request){
        $curDate = date("d/m/Y");
        try{
            $post = new Post([
                'title' =>$request->input('title'),
                'post_text' =>$request->input('editor'),
                'user_id' =>$request->input('user_id'),
            ]);
            $post->save();
            return redirect()->route('blogUser.post_editor');

        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error occurred while adding user']);
        }
    }
    public function deletePost($post_id){
        $post = Post::find($post_id);
        $post->delete();
        return redirect()->route('blogUser.post_editor');
    }
}
