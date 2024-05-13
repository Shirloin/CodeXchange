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
        "post_id",
        "parent_id"
    ];
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function parent(){
        return $this->belongsTo(Reply::class, 'parent_id');
    }
    public function replies(){
        return $this->hasMany(Reply::class, 'parent_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
        
    }
}
