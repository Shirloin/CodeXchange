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
            ['id' => getID(),
            'name' => 'C',
            'image' => 'assets/topic/c.png',],
            ['id' => getID(),
            'name' => 'Database',
            'image' => 'assets/topic/sql.png',],
            ['id' => getID(),
            'name' => 'Java',
            'image' => 'assets/topic/java.png',],
            ['id' => getID(),
            'name' => 'HTML',
            'image' => 'assets/topic/html.png',],
            ['id' => getID(),
            'name' => 'CSS',
            'image' => 'assets/topic/css.png',],
            ['id' => getID(),
            'name' => 'Javascript',
            'image' => 'assets/topic/javascript.png',],
            ['id' => getID(),
            'name' => 'Network',
            'image' => 'assets/topic/network.png',],
            ['id' => getID(),
            'name' => 'Laravel',
            'image' => 'assets/topic/laravel.png',],

        ]);
    }
}
