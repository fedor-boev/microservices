<?php

declare(strict_types=1);

namespace Database\Seeders\User;

use App\Modules\User\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(20)->create();

        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com'
        ]);

        User::factory()->create([
            'first_name' => 'Editor',
            'last_name' => 'Editor',
            'email' => 'editor@editor.com'
        ]);

        User::factory()->create([
            'first_name' => 'Viewer',
            'last_name' => 'Viewer',
            'email' => 'viewer@viewer.com'
        ]);

        User::factory()->create([
            'first_name' => 'Influencer',
            'last_name' => 'Influencer',
            'email' => 'i@i.com'
        ]);
    }
}
