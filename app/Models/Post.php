<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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
            $post->user->addXP(100);
            $post->user->posty();
            $post->user->bossy();
            $post->user->kingy();
        });
        static::updated(function ($post) {
            if ($post->isDirty("is_solved")) {
                if ($post->is_solved) {
                    $post->user->addXP(100);
                }
                $post->user->posty();
            }
            if ($post->isDirty("likes_count")) {
                $post->user->likey();
            }
        });
        static::deleting(function ($post) {
            foreach ($post->replies as $reply) {
                $reply->delete();
            }
            foreach ($post->likes as $like) {
                $like->unlike($post);
            }
        });
        static::deleted(function ($post) {
            $post->user->decrement('posts_count');
            $post->user->posty();
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
        return $this->morphMany(Reply::class, 'replyable');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkSolved()
    {
        $hasApproved = false;
        foreach ($this->replies as $reply) {
            if (!$reply->hasApprovedReplies()) {
                $hasApproved = false;
            } 
            else{
                $hasApproved = true;
                break;
            }
        }
        if($hasApproved && !$this->is_solved){
            $this->update(['is_solved' => true]);
        }else if(!$hasApproved && $this->is_solved){
            $this->update(['is_solved' => false]);
        }
    }
}
