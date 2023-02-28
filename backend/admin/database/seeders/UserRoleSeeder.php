<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = DB::connection('old_mysql')->table('user_roles')->get();

        foreach ($items as $item) {
            UserRole::create([
                'id' => $item->id,
                'user_id' => $item->user_id,
                'role_id' => $item->role_id,
            ]);
        }
    }
}
