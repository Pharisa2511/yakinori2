<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->binary('image_blob')->nullable();
            $table->string('image_mime', 100)->nullable();
            $table->string('status')->default('available');
            $table->decimal('price', 8, 2);

            $table->foreignId('category_id')
                ->constrained('categories', 'category_id')
                ->cascadeOnDelete();
        });

        DB::statement('ALTER TABLE menus MODIFY image_blob LONGBLOB NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
