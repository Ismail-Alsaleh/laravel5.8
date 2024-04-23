<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{

    public function addPost(array $data){
        return Post::create($data);
    }
    public function showPosts(){
        return Post::select('posts.*','blog_users.username','blog_users.user_id','blog_users.img')
        ->join('blog_users','blog_users.user_id','=','posts.user_id')
        ->orderBy('posts.created_at','desc');
    }
    public function deletePost($id){
        $user = Post::findOrFail($id);
        $user->delete();
    }
} 