<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\LinkProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $linkProducts = DB::connection('old_mysql')->table('link_products')->get();

        foreach ($linkProducts as $linkProduct) {
            LinkProduct::create([
                'id' => $linkProduct->id,
                'link_id' => $linkProduct->link_id,
                'product_id' => $linkProduct->product_id,
            ]);
        }
    }
}
