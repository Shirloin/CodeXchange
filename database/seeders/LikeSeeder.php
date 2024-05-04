<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $posts = Post::whereNotIn('id', function ($query) use ($user) {
                $query->select('post_id')
                    ->from('likes')
                    ->where('user_id', $user->id);
            })->inRandomOrder()->limit(5)->pluck('id');
            $user->likes()->attach($posts);
        }
    }
}
