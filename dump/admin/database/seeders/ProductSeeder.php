<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Product::factory(30)->create();

//        $items = \DB::table('products')->get();
//
//        foreach ($items as $item) {
//            Product::create([
//                'id' => $item->id,
//                'title' => $item->title,
//                'description' => $item->description,
//                'image' => $item->image,
//                'price' => $item->price,
//                'created_at' => $item->created_at,
//                'updated_at' => $item->updated_at,
//            ]);
//        }
    }
}
