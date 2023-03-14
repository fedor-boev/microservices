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
        Schema::create('order_items', static function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->references('id')
                ->on('orders');

            $table->string('product_title',150);
            $table->decimal('price');
            $table->unsignedInteger('quantity');
            $table->decimal('influencer_revenue');
            $table->decimal('admin_revenue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
