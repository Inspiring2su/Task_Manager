<?php

namespace Database\Factories;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'deadline' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'project_id' => Project::factory(), // Assuming each task belongs to a project
            'user_id' => User::factory(), // Assuming tasks are assigned to users
        ];
    }
}
