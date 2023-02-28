<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $permissions = Permission::all();

        $admin = Role::whereName('Admin')->firstOrFail();

        foreach ($permissions as $permission) {
            DB::table('permission_role')->insert([
                'role_id' => $admin->id,
                'permission_id' => $permission->id,
            ]);
        }

        $editor = Role::whereName('Editor')->firstOrFail();

        foreach ($permissions as $permission) {
            if ($permission->name !== 'edit_roles') {
                DB::table('permission_role')->insert([
                    'role_id' => $editor->id,
                    'permission_id' => $permission->id,
                ]);
            }
        }

        $viewer = Role::whereName('Viewer')->firstOrFail();

        $viewerRoles = [
            'view_users',
            'view_roles',
            'view_products',
            'view_orders',
        ];

        foreach ($permissions as $permission) {
            if (in_array($permission->name, $viewerRoles, true)) {
                DB::table('permission_role')->insert([
                    'role_id' => $viewer->id,
                    'permission_id' => $permission->id,
                ]);
            }
        }


//        $items = \DB::table('permission_role')->get();
//
//        foreach ($items as $item) {
//            \DB::table('permission_role')->insert([
//                'id' => $item->id,
//                'role_id' => $item->role_id,
//                'permission_id' => $item->permission_id,
//            ]);
//        }
    }
}
