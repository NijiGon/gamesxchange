<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(2, 11),
            'game_id' => fake()->numberBetween(1, 25),
            'rating' => fake()->numberBetween(1, 5), // Random rating between 1 and 5
            'comment' => fake()->sentence,
            'like' => fake()->numberBetween(1, 11),
            'dislike' => fake()->numberBetween(1, 11),
        ];
    }
}
