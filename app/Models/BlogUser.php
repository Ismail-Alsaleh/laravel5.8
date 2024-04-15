<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class BlogUser extends Model
{
    protected $table = 'blog_users';
    protected $primaryKey ='user_id';
    protected $fillable = [
        'username', 'gender','email','password','img'
    ];
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
