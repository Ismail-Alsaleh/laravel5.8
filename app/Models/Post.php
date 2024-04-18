<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'post_id';
    protected $table = 'posts';
    protected $fillable = [
        'title','post_text','user_id'
    ];
}
