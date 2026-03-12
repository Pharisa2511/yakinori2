<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    // เพิ่มคอลัมน์ timestamps ให้กับทุกตารางที่คุณต้องการ
    Schema::table('categories', function (Blueprint $table) { $table->timestamps(); });
    Schema::table('menus', function (Blueprint $table) { $table->timestamps(); });
    Schema::table('menu_options', function (Blueprint $table) { $table->timestamps(); });
    Schema::table('orders', function (Blueprint $table) { $table->timestamps(); });
    Schema::table('order_items', function (Blueprint $table) { $table->timestamps(); });
    Schema::table('payments', function (Blueprint $table) { $table->timestamps(); });
    Schema::table('tables', function (Blueprint $table) { $table->timestamps(); });
}

public function down()
{
    // ลบคอลัมน์ออกหากมีการย้อนกลับ (Rollback)
    Schema::table('categories', function (Blueprint $table) { $table->dropTimestamps(); });
    // ... ใส่ให้ครบทุกตาราง
}
};
