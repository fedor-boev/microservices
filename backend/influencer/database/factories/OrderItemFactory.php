<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        /** @var Product $product */
        $product = Product::inRandomOrder()->first();
        $quantity = $this->faker->numberBetween(1, 5);

        return [
            'product_title' => $product->title,
            'price' => $product->price,
            'quantity' => $quantity,
            'revenue' => 0.1 * $product->price * $quantity,
        ];
    }
}
