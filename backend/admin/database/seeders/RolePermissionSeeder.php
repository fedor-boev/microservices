<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = DB::connection('old_mysql')->table('role_permission')->get();

        foreach ($items as $item) {
            DB::table('role_permission')->insert([
                'id' => $item->id,
                'role_id' => $item->role_id,
                'permission_id' => $item->permission_id,
            ]);
        }
    }
}
