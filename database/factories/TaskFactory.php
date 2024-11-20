<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{

    protected $model = Task::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'creator_id' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence(4), 
            'description' => $this->faker->paragraph(),
            'start_date' => $this->faker->date(),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
        ];
    }
}