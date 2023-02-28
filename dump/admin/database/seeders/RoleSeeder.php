<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Editor']);
        Role::create(['name' => 'Viewer']);

//        $items = \DB::table('roles')->get();
//        foreach ($items as $item) {
//            Role::create([
//                'id' => $item->id,
//                'name' => $item->name,
//            ]);
//        }
    }
}
