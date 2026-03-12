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
         Schema::create('used_ins', function (Blueprint $table) {

            $table->foreignId('order_item_id')
                ->constrained('order_items', 'order_item_id')
                ->onDelete('cascade');

            $table->string('option_id');

            $table->foreign('option_id')
                ->references('option_id')
                ->on('menu_options')
                ->onDelete('cascade');
            $table->primary(['order_item_id', 'option_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('used_ins');
    }
};
