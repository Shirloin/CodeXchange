<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $table = "topics";
    public $incrementing = false;
    protected $keyType = 'string';

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_topics', 'topic_id', 'post_id');
    }
}
