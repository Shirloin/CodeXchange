<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = "posts";
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $fillable = [
        "title",
        "content",
        "is_solved",
        "replies_count",
        "likes_count",
        "user_id",
        'topic_id'
    ];
    protected static function booted()
    {
        static::created(function ($post) {
            $post->user->increment('posts_count');
            $post->user->increment('xp', 100);
        });
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }

    public function libraries()
    {
        return $this->belongsToMany(Post::class, 'libraries', 'post_id', 'user_id');
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
