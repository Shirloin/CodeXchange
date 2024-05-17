<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'dob',
        'gender',
        'image',
        'xp',
        'level',
        'posts_count',
        'replies_count',
        'likes_count'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function booted()
    {
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
    }
    public function libraries()
    {
        return $this->hasMany(Post::class, 'libraries', 'post_id', 'user_id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements', 'user_id', 'achievement_id');
    }
    public function hasLikedPost(Post $post)
    {
        return $this->likes()->where('post_id', $post->id)->exists();
    }
    public function like(Post $post)
    {
        if (!$this->hasLikedPost($post)) {
            $like = new Like();
            $like->user_id = $this->id;
            $like->post_id = $post->id;
            $like->save();
        }
        return $this;
    }

    public function unlike(Post $post)
    {
        $this->likes()->detach($post->id);
        return $this;
    }

    public function addXP($count)
    {
        if ($this->xp >= 5000) {
            return;
        }
        if ($this->xp + $count > 5000) {
            $this->xp = 5000;
            $this->save();
        } else {
            $this->increment('xp', $count);
        }
    }

    public function minXP($count)
    {
        if ($this->xp <= 0 || $this->xp - $count < 0) {
            return;
        } else {
            $this->decrement('xp', $count);
        }
    }

    public function solvedPost()
    {
        $solvedPosts = $this->posts()->where('is_solved', true)->count();
        $achievement = Achievement::where('name', 'Posty Posty')->first();
        if (!$achievement) {
            return;
        }
        if ($solvedPosts >= 5) {
            if ($achievement) {
                $this->achievements()->syncWithoutDetaching([$achievement->id]);
            }
        } else {
            if ($this->achievements()->where('achievement_id', $achievement->id)->exists()) {
                $this->achievements()->detach($achievement->id);
            }
        }
    }
}
