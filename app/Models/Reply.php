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
            $reply->user->increment('xp', 50);
            if ($reply->replyable instanceof Post) {
                $reply->replyable->increment('replies_count');
            }
        });
        static::deleted(function ($reply) {
            $reply->user->decrement('replies_count');
            if ($reply->replyable instanceof Post) {
                $reply->replyable->decrement('replies_count');
            }
        });
    }
    public function post()
    {
        return $this->morphTo('replyable');
    }
    public function parent()
    {
        return $this->belongsTo(Reply::class, 'parent_id');
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
}
