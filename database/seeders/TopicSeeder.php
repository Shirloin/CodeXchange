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
                'image' => '/assets/topics/c.svg',
            ],
            [
                'id' => getID(),
                'name' => 'SQL',
                'image' => '/assets/topics/sql.svg',
            ],
            [
                'id' => getID(),
                'name' => 'MongoDB',
                'image' => '/assets/topics/mongodb.svg',
            ],
            [
                'id' => getID(),
                'name' => 'Java',
                'image' => '/assets/topics/java.svg',
            ],
            [
                'id' => getID(),
                'name' => 'HTML',
                'image' => '/assets/topics/html.svg',
            ],
            [
                'id' => getID(),
                'name' => 'CSS',
                'image' => '/assets/topics/css.svg',
            ],
            [
                'id' => getID(),
                'name' => 'Javascript',
                'image' => '/assets/topics/javascript.svg',
            ],
            [
                'id' => getID(),
                'name' => 'Network',
                'image' => '/assets/topics/network.svg',
            ],
            [
                'id' => getID(),
                'name' => 'Laravel',
                'image' => '/assets/topics/laravel.svg',
            ],

        ]);
    }
}
