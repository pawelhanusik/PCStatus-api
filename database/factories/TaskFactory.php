<?php

namespace Database\Factories;

use App\Enums\TaskStatusEnum;
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
    public function definition()
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        $computer = $user->computers()->first();

        $status = match (random_int(0, 3)) {
            0 => TaskStatusEnum::CREATED,
            1 => TaskStatusEnum::STARTED,
            2 => TaskStatusEnum::RUNNING,
            default => TaskStatusEnum::DONE,
        };

        return [
            'user_id' => $user->id,
            'computer_id' => $computer?->id,
            'title' => $this->faker->word(),
            'status' => $status,
            'message' => random_int(0, 1) ? $this->faker->sentence(random_int(6, 20)) : null,
        ];
    }
}
