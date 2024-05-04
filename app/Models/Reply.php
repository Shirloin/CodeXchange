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
    protected $fillable = [
        "content",
        "is_approved",
        "user_id",
        "post_id",
        "parent_id"
    ];
}
