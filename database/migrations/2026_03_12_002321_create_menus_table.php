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

        Schema::create('menus', function (Blueprint $table) {

            $table->string('menu_id')->primary();
            $table->string('menu_name');
            $table->string('image')->nullable();
            $table->string('status')->default('available');
            $table->decimal('price', 8, 2);

            $table->string('category_id');

            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
