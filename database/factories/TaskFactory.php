<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'completed' => false,
            'completed_at' => null,
            'deleted_at' => null,
            'attachment' => null,
            'user_id' => 1,
        ];
    }
}
