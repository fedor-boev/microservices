<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run(): void
    {
        Order::factory(30)->create()
            ->each(function (Order $order) {
                OrderItem::factory(random_int(1, 5))->create([
                    'order_id' => $order->id,
                ]);
            });

//        $items = \DB::table('order_items')->get();
//
//        foreach ($items as $item) {
//            OrderItem::create([
//                'id' => $item->id,
//                'order_id' => $item->order_id,
//                'product_title' => $item->product_title,
//                'price' => $item->price,
//                'quantity' => $item->quantity,
//                'revenue' => $item->admin_revenue,
//                'created_at' => $item->created_at,
//                'updated_at' => $item->updated_at,
//            ]);
//        }
    }
}
