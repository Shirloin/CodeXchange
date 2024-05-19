<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            UserSeeder::class,
            TopicSeeder::class,
            PostSeeder::class,
            ReplySeeder::class,
            LikeSeeder::class,
        ]);
        DB::table('users')->insert([
            'id' => getID(),
            'email' =>  'a@gmail.com',
            'username' =>  'test',
            'password' => bcrypt('test'),
            'image' => '/assets/achievements/slc.png'
        ]);
    }
}
