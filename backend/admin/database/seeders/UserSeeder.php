<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory(20)->create();

        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'role_id' => 1,
        ]);

        User::factory()->create([
            'first_name' => 'Editor',
            'last_name' => 'Editor',
            'email' => 'editor@editor.com',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'first_name' => 'Viewer',
            'last_name' => 'Viewer',
            'email' => 'viewer@viewer.com',
            'role_id' => 3,
        ]);

//        $users = \DB::table('users')->get();
//
//        foreach ($users as $user){
//            User::create([
//                'id' => $user->id,
//                'first_name' => $user->first_name,
//                'last_name' => $user->last_name,
//                'email' => $user->email,
//                'password' => $user->password,
//                'created_at' => $user->created_at,
//                'updated_at' => $user->updated_at,
//                'is_influencer' => $user->is_influencer,
//            ]);
//        }
    }
}
