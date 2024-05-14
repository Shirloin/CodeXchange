<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = "likes";
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $fillable = [
        "user_id",
        "post_id"
    ];
    protected $primary = [
        "user_id",
        "post_id"
    ];
    protected static function booted()
    {
        static::created(function ($like) {
            $like->post->increment('likes_count');
            $like->user->increment('likes_count');
        });
        static::deleted(function ($like) {
            $like->post->decrement('likes_count');
            $like->user->decrement('likes_count');
        });
    }
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
