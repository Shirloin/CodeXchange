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
            $reply->user->addXP(50);
            while($reply->replyable instanceof Reply){
                $reply = $reply->replyable;
            }
            if ($reply->replyable instanceof Post) {
                $reply->replyable->increment('replies_count');
                if($reply->is_approved){
                    $reply->replyable->is_solved = true;
                    $reply->replyable->save();
                }
            }
        });
        static::updated(function ($reply) {
            if ($reply->replyable instanceof Post) {

            }
        });
        static::deleted(function ($reply) {
            $reply->user->decrement('replies_count');
            $reply->user->minXP(50);
            if ($reply->replyable instanceof Post) {
                $reply->replyable->decrement('replies_count');
            }
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
}
