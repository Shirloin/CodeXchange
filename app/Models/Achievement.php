<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    protected $table = "achievements";
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        "name",
        "image",
        "description",
    ];
    public $timestamps = true;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievements' . 'achivement_id', 'user_id');
    }
}
