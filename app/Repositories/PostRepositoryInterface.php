<?php

namespace App\Repositories;

Interface PostRepositoryInterface
{
    public function addPost(array $data);
    public function deletePost($id);
    public function showPosts();
}