<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Throwable
     */
    public function run(): void
    {
        $permissions = Permission::all();

        $admin = Role::whereName('Admin')->first();

        throw_if(!$admin, 'RuntimeException', 'Role Admin not found');

        foreach ($permissions as $permission) {
            DB::table('role_permission')->insert([
                'role_id' => $admin->id,
                'permission_id' => $permission->id,
            ]);
        }

        $editor = Role::whereName('Editor')->first();

        throw_if(!$editor, 'RuntimeException', 'Role Editor not found');

        foreach ($permissions as $permission) {
            if ($permission->name !== 'edit_roles') {
                DB::table('role_permission')->insert([
                    'role_id' => $editor->id,
                    'permission_id' => $permission->id,
                ]);
            }
        }

        $viewer = Role::whereName('Viewer')->first();

        throw_if(!$viewer, 'RuntimeException', 'Role Viewer not found');

        $viewerRoles = [
            'view_users',
            'view_roles',
            'view_products',
            'view_orders',
        ];

        foreach ($permissions as $permission) {
            if (in_array($permission->name, $viewerRoles, true)) {
                DB::table('role_permission')->insert([
                    'role_id' => $viewer->id,
                    'permission_id' => $permission->id,
                ]);
            }
        }
    }
}
