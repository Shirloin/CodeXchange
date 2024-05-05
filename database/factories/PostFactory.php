<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use function App\Helper\getID;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
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
            'title' => $this->faker->words(3, true),
            'content' => $this->faker->paragraph(rand(1, 3), true),
            'user_id' =>  User::all()->random()->id,
            'is_solved' => $this->faker->randomElement([true, false]),
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            $topics = Topic::all()->shuffle()->take(rand(1, 3));
            $post->topics()->attach($topics);
        });
    }
}
