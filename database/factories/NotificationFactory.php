<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
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

        return [
            'user_id' => $user->id,
            'computer_id' => $computer?->id,
            'title' => $this->faker->word(),
            'message' => random_int(0, 1) ? $this->faker->sentence(random_int(6, 20)) : null,
        ];
    }
}
