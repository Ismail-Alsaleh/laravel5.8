<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'comment_id';
    protected $table = 'comments';
    protected $fillable =([
        'comment_content','post_id','user_id','accepted'
    ]);
}
