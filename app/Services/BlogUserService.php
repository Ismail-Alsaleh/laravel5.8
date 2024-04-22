<?php

namespace App\Services;

use App\Repositories\BlogUserRepositoryInterface;


class BlogUserService {
    public function __construct(
        BlogUserRepositoryInterface $blogUserRepository
    ){
        $this->blogUserRepository = $blogUserRepository;
    }
    public function blogUserRegistration(array $data){
        return $this->blogUserRepository->blogUserRegistration($data);
    }
    
}