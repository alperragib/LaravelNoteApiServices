<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, User::count()),
            'title' => fake()->text(),
            'content' => fake()->paragraph(),
            'category' => $this->faker->randomElement(['todo', 'reminder', 'account', 'other']),
            'updated_at' => fake()->dateTime(),
        ];
    }
}