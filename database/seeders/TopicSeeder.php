<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function App\Helper\getID;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            [
                'id' => getID(),
                'name' => 'C',
                'image' => '/assets/topics/c.png',
            ],
            [
                'id' => getID(),
                'name' => 'Database',
                'image' => '/assets/topics/sql.png',
            ],
            [
                'id' => getID(),
                'name' => 'Java',
                'image' => '/assets/topics/java.png',
            ],
            [
                'id' => getID(),
                'name' => 'HTML',
                'image' => '/assets/topics/html.png',
            ],
            [
                'id' => getID(),
                'name' => 'CSS',
                'image' => '/assets/topics/css.png',
            ],
            [
                'id' => getID(),
                'name' => 'Javascript',
                'image' => '/assets/topics/javascript.png',
            ],
            [
                'id' => getID(),
                'name' => 'Network',
                'image' => '/assets/topics/network.png',
            ],
            [
                'id' => getID(),
                'name' => 'Laravel',
                'image' => '/assets/topics/laravel.png',
            ],

        ]);
    }
}
