<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $table = "replies";
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $fillable = [
        "content",
        "is_approved",
        "user_id",
        'replyable_id',
        'replyable_type'
    ];
    protected static function booted()
    {
        static::created(function ($reply) {
            $reply->user->increment('replies_count');
            $reply->user->addXP(100);
            $replyParent = $reply;
            // Get Reply Post
            // while ($replyParent->replyable instanceof Reply) {
            //     $replyParent = $replyParent->replyable;
            // }
            // $post = $replyParent->replyable;
            $post = $reply->getReplyPost($reply);
            if ($post instanceof Post) {
                $post->increment('replies_count');
                if ($reply->is_approved) {
                    $post->is_solved = true;
                    $post->save();
                }
            }
            $reply->user->chaty();
        });
        static::updated(function ($reply) {
            if ($reply->isDirty('is_approved') && $reply->is_approved) {
                $reply->user->addXP(100);
                $reply->user->goody();
            }
        });
        static::deleted(function ($reply) {
            $reply->user->decrement('replies_count');
            $reply->user->minXP(100);
            $post = $reply->getReplyPost($reply);
            if ($post instanceof Post) {
                $post->decrement('replies_count');
                $post->checkSolved();
            }
            $reply->user->chaty();
            $reply->user->goody();
        });
    }
    public function post()
    {
        return $this->morphTo('replyable');
    }
    public function replies()
    {
        return $this->morphMany(Reply::class, 'replyable');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replyable()
    {
        return $this->morphTo();
    }
    public function hasApprovedReplies()
    {
        $hasApproved = $this->is_approved;
        foreach ($this->replies as $reply) {
            if ($reply->hasApprovedReplies()) {
                $hasApproved = true;
                break;
            }
        }
        return $hasApproved;
    }
    public function getReplyPost($reply)
    {
        if ($reply->replyable instanceof Reply) {
            return $reply->getReplyPost($reply->replyable);
        }
        return $reply->replyable;
    }
}
