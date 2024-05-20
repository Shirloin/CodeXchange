<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        static::updated(function ($user) {
            if($user->isDirty('xp')){
                $user->bossy();
                $user->kingy();
            }
        });
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
    }
    public function libraries()
    {
        return $this->belongsToMany(Post::class, 'libraries', 'user_id', 'post_id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements', 'user_id', 'achievement_id');
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function hasPost(Post $post){
        return $this->libraries()->where('post_id', $post->id)->exists();
    }
    public function addToLibrary(Post $post){
        if(!$this->hasPost($post)){
            $this->libraries()->attach($post->id);
        }
        else{
            $this->libraries()->detach($post->id);
        }
        return $this;
    }
    public function hasLikedPost(Post $post)
    {
        return $this->likes()->where('post_id', $post->id)->exists();
    }
    public function like(Post $post)
    {
        if (!$this->hasLikedPost($post)) {
            $this->likes()->attach($post->id);
            $post->increment('likes_count');
            $this->increment('likes_count');
            $this->addXP(50);
        }
        $this->bossy();
        $this->kingy();
        return $this;
    }

    public function unlike(Post $post)
    {
        $this->likes()->detach($post->id);
        if ($post->likes_count > 0) {
            $post->decrement('likes_count');
        }
        if ($this->likes_count > 0) {
            $this->decrement('likes_count');
        }
        return $this;
    }

    public function addXP($count)
    {
        if ($this->xp + $count > 5000 || $this->xp >= 5000) {
            $this->xp = 5000;
            $this->save();
        } else {
            $this->increment('xp', $count);
        }
       
    }

    public function goody()
    {
        $achievement = Achievement::where('name', 'Goody Goody')->first();
        if (!$achievement) {
            return;
        }
        $approvedPosts = $this->replies()->where("is_approved", true)->count();
        if ($approvedPosts >= 3 && !$this->hasAchievement($achievement)) {
            $this->addAchievement($achievement);
            $this->addXP(150);
        } 
        $this->nar();
    }

    public function likey()
    {
        $achievement = Achievement::where('name', 'Likey Likey')->first();
        if (!$achievement) {
            return;
        }
        $postLikes = $this->posts()->where('likes_count', '>=', 10)->exists();
        if ($postLikes && !$this->hasAchievement($achievement) ) {
            $this->addAchievement($achievement);
            $this->addXP(200);
        } 
        $this->nar();
    }

    public function chaty()
    {
        $achievement = Achievement::where('name', 'Chaty Chaty')->first();
        if ($this->replies_count >= 10 && !$this->hasAchievement($achievement)) {
            $this->addAchievement($achievement);
            $this->addXP(250);
        } 
        $this->nar();
    }

    public function posty()
    {
        $achievement = Achievement::where('name', 'Posty Posty')->first();
        $solvedPosts = $this->posts()->where('is_solved', true)->count();
        if ($solvedPosts >= 5 && !$this->hasAchievement($achievement)) {
            $this->addAchievement($achievement);
            $this->addXP(300);
        } 
        $this->nar();
    }

    public function bossy()
    {
        $achievement = Achievement::where('name', 'Bossy Bossy')->first();
        if ($this->xp >= 1000 && !$this->hasAchievement($achievement)) {
            $this->addAchievement($achievement);
            $this->addXP(500);
        } 
        $this->nar();
    }



    public function kingy()
    {
        $achievement = Achievement::where('name', 'Kingy Kingy')->first();
        if ($this->xp >= 5000 && !$this->hasAchievement($achievement)) {
            $this->addAchievement($achievement);
        } 
        $this->nar();
    }
    public function nar()
    {
        $achievement = Achievement::where('name', 'NAR NAR')->first();
        $achievementCount = $this->achievements()->count();
        if ($achievementCount >= 6 &&  !$this->hasAchievement($achievement)) {
            $this->addAchievement($achievement);
        }
    }
    public function hasAchievement($achievement){
        return $this->achievements()->where('achievement_id', $achievement->id)->exists();
    }
    public function addAchievement($achievement){
        $this->achievements()->syncWithoutDetaching([$achievement->id]);
    }
    public function removeAchievement($achievement){
        $this->achievements()->detach($achievement->id);

    }
}
