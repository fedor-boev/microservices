<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = DB::connection('old_mysql')->table('orders')->get();

        foreach ($items as $item) {
            Order::create([
                'id' => $item->id,
                'code' => $item->code,
                'transaction_id' => $item->transaction_id,
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'email' => $item->email,
                'user_id' => $item->user_id,
                'influencer_email' => $item->influencer_email,
                'address' => $item->address,
                'address2' => $item->address2,
                'city' => $item->city,
                'country' => $item->country,
                'zip' => $item->zip,
                'complete' => $item->complete,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }
    }
}
