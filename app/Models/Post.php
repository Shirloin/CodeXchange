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
        "user_id"
    ];
    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'post_topics', 'post_id', 'topic_id');
    }

    public function likes()
    {
        return $this->belongsToMany(Like::class, 'likes', 'post_id', 'user_id');
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
