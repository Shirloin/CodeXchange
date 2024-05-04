<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTopic extends Model
{
    use HasFactory;
    protected $table = "post_topics";
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        "post_id",
        "topic_id"
    ];
    protected $primary = ['post_id', 'topic_id'];
}
