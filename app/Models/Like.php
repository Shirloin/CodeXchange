<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = "likes";
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        "user_id",
        "post_id"
    ];
    protected $primary = [
        "user_id",
        "post_id"
    ];
}
