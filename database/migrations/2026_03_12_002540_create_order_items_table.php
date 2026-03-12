<?php

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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_item_id');

            $table->text('note')->nullable();
            $table->string('status')->default('ordered');

            $table->decimal('price', 8, 2);
            $table->integer('quantity');

            $table->string('menu_id');

            $table->foreign('menu_id')
                ->references('menu_id')
                ->on('menus')
                ->onDelete('cascade');

            $table->foreignId('order_id')
                ->constrained('orders', 'order_id')
                ->onDelete('cascade');
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
