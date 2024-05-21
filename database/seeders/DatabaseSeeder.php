<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function App\Helper\getID;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AchievementSeeder::class,
            TopicSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
            ReplySeeder::class,
            LikeSeeder::class,
        ]);
        $user = new User([
            'id' => 'myuser',
            'email' =>  'a@gmail.com',
            'username' =>  'test',
            'password' => bcrypt('test'),
            'image' => '/assets/achievements/slc.png'
        ]);
        $user->save();
    }
}
