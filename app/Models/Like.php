<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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
    public static function booted()
    {
        static::created(function ($like) {
            $like->user->addXP(50);
            $like->user->increment('likes_count');
            $like->post->increment('likes_count');
            $like->user->bossy();
            $like->user->kingy();
        });
        static::deleted(function ($like){
            Log::debug("like deleted");
        });
    }
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
