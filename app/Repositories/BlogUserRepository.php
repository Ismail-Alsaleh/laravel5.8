<?php

namespace App\Repositories;

use App\Models\BlogUser;
use App\Repositories\BlogUserRepositoryInterface;

class BlogUserRepository implements BlogUserRepositoryInterface
{
    public function blogUserRegistration(array $data){
        return BlogUser::create($data);
    }
    // public function authenticate(array $data){
    //     return BlogUser::findOrFail(data)
    // }
    public function find($id){
        return BlogUser::find($id);
    }
}