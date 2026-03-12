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
       Schema::create('menu_options', function (Blueprint $table) {
            $table->string('option_id')->primary();
            $table->string('option_name');
            $table->decimal('extra_price', 8, 2)->default(0);

            $table->string('menu_id');

            $table->foreign('menu_id')
                ->references('menu_id')
                ->on('menus')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_options');
    }
};
