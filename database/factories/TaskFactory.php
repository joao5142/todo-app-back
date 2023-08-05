<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;


    public function definition()
    {
        $userId = User::inRandomOrder()->first()->id;
        return [
            'description' => $this->faker->sentence,
            'completed' => $this->faker->boolean,
            'user_id' => $userId
        ];
    }
}
