<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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
            $post = $reply->getReplyPost($reply);
            if ($post instanceof Post) {
                $post->increment('replies_count');
                $post->checkSolved();
            }
            $reply->user->chaty();
            $reply->user->bossy();
            $reply->user->kingy();
        });
        static::updated(function ($reply) {
            if ($reply->isDirty('is_approved') ) {
                if($reply->is_approved){
                    $reply->user->addXP(100);
                    $reply->user->goody();
                }
            }
            $reply->user->bossy();
            $reply->user->kingy();
        });
        static::deleting(function ($reply) {
            foreach ($reply->replies as $reply) {
                $reply->delete();
            }
            
        });
        static::deleted(function ($reply) {
            $reply->user->decrement('replies_count');
            $post = $reply->getReplyPost($reply);
            if ($post instanceof Post) {
                $post->decrement('replies_count');
                $post->checkSolved();
            }            

            $reply->user->goody();
            $reply->user->chaty();
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
