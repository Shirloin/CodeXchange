<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        foreach($posts as $post){
            $topics = Topic::inRandomOrder()->limit(rand(1, 3))->get();
            foreach ($topics as $topic) {
                $post->topics()->syncWithoutDetaching([$topic->id]);
            }
        }
    }
}
