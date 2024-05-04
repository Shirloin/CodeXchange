<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use function App\Helper\getID;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reply>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => getID(),
            'content' => $this->faker->words(10, true),
            'user_id' => User::all()->random()->id,
            'post_id' => Post::all()->random()->id,
        ];
    }
}
