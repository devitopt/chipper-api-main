<?php

namespace Database\Factories;

use App\Models\Favorite;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Favorite::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $favoriteable = $this->favoriteable();

        return [
            'favoriteable_id' => $favoriteable::factory(),
            'favoriteable_type' => $favoriteable,
            'user_id' => User::factory(),
        ];
    }

    public function favoriteable()
    {
        return $this->faker->randomElement([
            Post::class,
            User::class,
        ]);
    }
}
