<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = DB::connection('old_mysql')->table('links')->get();

        foreach ($links as $link) {
            Link::create([
                'id' => $link->id,
                'code' => $link->code,
                'user_id' => $link->user_id,
                'created_at'=> $link->created_at,
                'updated_at'=> $link->updated_at,
            ]);
        }
    }
}
