<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function App\Helper\getID;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 500; $i++) {
            $post = Post::inRandomOrder()->first();
            $user_id = User::all()->random()->id;
            $reply = new Reply();
            $reply->id = getID();
            $reply->content = fake()->words(10, true);
            $reply->user_id = $user_id;
            $reply->is_approved =  fake()->randomElement([false, true]);
            $reply->replyable()->associate($post);
            $reply->save();
        }
    }
}
