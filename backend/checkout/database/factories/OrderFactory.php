<?php

namespace Database\Factories;

use App\Models\Link\Link;
use Illuminate\Database\Eloquent\Factories\Factory;
use Microservices\UserService;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     * @throws \Exception
     * @throws \Throwable
     */
    public function definition(): array
    {
        /** @var Link $link */
        $link = Link::inRandomOrder()->first();
        $user = (new UserService())->find($link->user_id);

        throw_if($user, 'RuntimeException', 'User not found');

        if ($user['is_influencer'] === 1) {
            return [
                'code' => $link->code,
                'user_id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'influencer_email' => $user['email'],
                'complete' => random_int(0,1)
            ];
        }

        return [];
    }
}
