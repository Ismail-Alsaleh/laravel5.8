<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class BlogUser extends Model implements Authenticatable
{
    use Notifiable;
    protected $table = 'blog_users';
    protected $primaryKey ='user_id';
    protected $fillable = [
        'username', 'gender','email','password','img'
    ];
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    public function getAuthIdentifierName()
    {
        return 'user_id'; // Name of the primary key column
    }

    public function getAuthIdentifier()
    {
        return $this->getKey(); // Returns the value of the primary key
    }

    public function getAuthPassword()
    {
        return $this->password; // Returns the hashed password
    }

    public function getRememberToken()
    {
        return $this->remember_token; // Returns the remember token
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value; // Sets the remember token
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; // Name of the remember token column
    }
}
