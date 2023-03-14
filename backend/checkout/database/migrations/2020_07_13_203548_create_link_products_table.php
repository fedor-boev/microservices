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
        Schema::create('link_products', static function (Blueprint $table) {
            $table->id();

            $table->foreignId('link_id')
                ->constrained()
                ->references('id')
                ->on('links');

            $table->foreignId('product_id')
                ->constrained()
                ->references('id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_product');
    }
};
