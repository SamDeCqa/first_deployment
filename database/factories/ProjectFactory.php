<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public $statuses = ['Pending', 'In Progress', 'Completed'];

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'title' => fake()->sentence(2),
            'description' => fake()->paragraph(5),
            'status' => fake()->randomElement($this->statuses),
        ];
    }
}
