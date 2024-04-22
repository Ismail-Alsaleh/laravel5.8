<?php

namespace App\Repositories;

Interface BlogUserRepositoryInterface
{
    public function blogUserRegistration(array $data);
    // public function authenticate(array $data);
    public function find($id);
}