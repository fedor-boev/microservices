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
        Permission::insert([
            ['name' => 'view_users'],
            ['name' => 'edit_users'],

            ['name' => 'view_roles'],
            ['name' => 'edit_roles'],

            ['name' => 'view_products'],
            ['name' => 'edit_products'],

            ['name' => 'view_orders'],
            ['name' => 'edit_orders'],
        ]);
    }
}
