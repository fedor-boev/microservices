<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Microservices\UserService;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1h Authorization
        Cache::remember('Authorization', 60 * 60, static function () {
            $endpoint = env('USERS_ENDPOINT');
            $username = env('START_PROJECT_USERNAME');
            $password = env('START_PROJECT_PASSWORD');
            $scope = env('START_PROJECT_SCOPE');

            return Http::retry(3, 5)->post("$endpoint/login", [
                'email' => $username,
                'password' => $password,
                'scope' => $scope
            ])->throw()->json()['token'];
        });

        // 1h User
        Cache::remember('users', 60 * 60, static function () {
            return (new UserService())->paginate(-1);
        });

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            ProductSeeder::class,
            OrderSeeder::class
        ]);

        Cache::delete('Authorization');
        Cache::delete('user');
    }
}
