<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommentController;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // protected $postService;
    protected $postRepository;
    public function __construct(
        // PostService $postService
        PostRepositoryInterface $postRepository
    ){
        // $this->postService = $postService;
        $this->postRepository = $postRepository;
    }
    public function showPosts(){
        // $posts = Post::select('posts.*','blog_users.username','blog_users.user_id','blog_users.img')->join('blog_users','blog_users.user_id','=','posts.user_id')->orderBy('posts.created_at','desc')->get();
        $comments = CommentController::getComments();
        // $posts = $this->postService->showPosts();
        $posts = $this->postRepository->showPosts(); 
        // $posts = "mew";

        return view('blogUser.blog_home', ['comments' => $comments, 'posts' => $posts]);
        return $posts;
    }
    // public function realPosts(){
    //     $posts = Post::select('posts.*','blog_users.username','blog_users.user_id','blog_users.img')->join('blog_users','blog_users.user_id','=','posts.user_id')->orderBy('posts.created_at','desc')->get();
    //     return view('blogUser.post_editor', ['posts'=>$posts]);
    // }
    public function addPost(CreatePostRequest $request){
        // $curDate = date("d/m/Y");
        try{
            // $post = new Post([
            //     'title' =>$request->input('title'),
            //     'post_text' =>$request->input('editor'),
            //     'user_id' =>$request->input('user_id'),
            // ]);
            // $post->save();
            
            $data['title'] = $request->input('title');
            $data['post_text']= $request->input('editor');
            $data['user_id']= $request->input('user_id');           

            // $post = $this->postService->addPost($data);
            $post = $this->postRepository->addPost($data);
            return redirect()->route('blogUser.post_editor');

        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error occurred while adding user']);
        }
    }
    public function deletePost($post_id){
        // $post = Post::find($post_id);
        // $post->delete();
        $this->postRepository->deletePost($post_id);
        return redirect()->route('blogUser.post_editor');
    }
}
