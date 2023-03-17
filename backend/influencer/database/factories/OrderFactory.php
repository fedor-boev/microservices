<?php

namespace Database\Factories;

use App\Models\Link\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        /** @var Link $link */
        $link = Link::inRandomOrder()->first();

        return [
            'code' => $link->code,
            'user_id' => $link->user->id,
        ];
    }
}
