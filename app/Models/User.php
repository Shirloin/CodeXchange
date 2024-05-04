<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'dob',
        'gender',
        'image',
        'xp'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function likes(){
        return $this->belongsToMany(Like::class, 'likes', 'user_id', 'post_id');
    }
    public function libraries(){
        return $this->hasMany(Post::class, 'libraries', 'post_id', 'user_id');
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function achievements(){
        return $this->hasMany(Achievement::class, 'user_achievements', 'user_id', 'achievements_id');
    }
}
