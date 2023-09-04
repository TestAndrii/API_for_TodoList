<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'done' => rand(0,1),
            'priority' => rand(1,5),
            'title' => Str::random(10),
            'createdAt' => now(),
            'completedAt' => now(),
            'subtask' => rand(0,10),
            'user_id' => rand(1,10)
        ];
    }
}
