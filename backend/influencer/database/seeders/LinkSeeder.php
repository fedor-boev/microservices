<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Link;
use App\Models\LinkProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Link::factory(30)->create()->each(function (Link $link) {
            LinkProduct::create([
                'link_id' => $link->id,
                'product_id' => Product::inRandomOrder()->first()->id
            ]);
        });
    }
}
