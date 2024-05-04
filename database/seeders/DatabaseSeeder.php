<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            PostTopicSeeder::class,
            ReplySeeder::class,
            LikeSeeder::class,
        ]);
    }
}
