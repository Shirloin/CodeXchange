<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function App\Helper\getID;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('achievements')->insert([
            [
                'id' => getID(),
                'name' => 'Goody Goody',
                'description' => 'Rewarded after 3 approved of your replies',
                'image' => '/assets/achievements/goody.svg'
            ],
            [
                'id' => getID(),
                'name' => 'Likey Likey',
                'description' => 'Rewarded after having 10 likes in your post',
                'image' => '/assets/achievements/likey.svg'
            ],
            [
                'id' => getID(),
                'name' => 'Chaty Chaty',
                'description' => 'Rewarded after doing 10 replies',
                'image' => '/assets/achievements/chaty.svg'
            ],
            [
                'id' => getID(),
                'name' => 'Posty Posty',
                'description' => 'Rewarded after 5 post solved in your posts',
                'image' => '/assets/achievements/posty.svg'
            ],
            [
                'id' => getID(),
                'name' => 'Bossy Bossy',
                'description' => 'Rewarded after having 1000xp',
                'image' => '/assets/achievements/bossy.svg'
            ],
            [
                'id' => getID(),
                'name' => 'Kingy Kingy',
                'description' => 'Rewarded after having 5000xp',
                'image' => '/assets/achievements/kingy.svg'
            ],
            [
                'id' => getID(),
                'name' => 'NAR NAR',
                'description' => 'Rewarded after having all of the remain achievements',
                'image' => '/assets/achievements/slc.png'
            ],
        ]);
    }
}
