<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->slug,
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
