<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\LinkProduct;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = DB::connection('old_mysql')->table('permissions')->get();

        foreach ($items as $item) {
            Permission::create([
                'id' => $item->id,
                'name' => $item->name,
            ]);
        }
    }
}
