<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'       => $this->faker->unique()->sentence(6),
            'description' => $this->faker->paragraph(),
            'status'      => $this->faker->randomElement(['pending', 'in progress', 'done']),
            'category_id' => Category::factory(),
            'user_id'     => User::factory(),
        ];
    }
}
