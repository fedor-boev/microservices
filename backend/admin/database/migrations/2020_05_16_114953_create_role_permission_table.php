<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_permission', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')
                ->constrained()
                ->references('id')
                ->on('roles');

            $table->foreignId('permission_id')
                ->constrained()
                ->references('id')
                ->on('permissions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permission');
    }
};
