<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = DB::connection('old_mysql')->table('roles')->get();

        foreach ($items as $item) {
            Role::create([
                'id' => $item->id,
                'name' => $item->name,
            ]);
        }
    }
}
