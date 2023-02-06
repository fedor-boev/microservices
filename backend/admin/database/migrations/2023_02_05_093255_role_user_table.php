<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('role_user', static function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('role_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        $users = User::pluck('id')->all();

        foreach($users as $user) {
            DB::table('role_user')->insert([
                'user_id' => $user->id,
                'role_id' => $user->role_id,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
