<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

// หน้าแรกสำหรับดูเมนูทั้งหมดของโต๊ะนั้น
Route::get('/menu/{table_number}', [MenuController::class, 'showMenu'])->name('menu.show');

// เพิ่มบรรทัดนี้: สำหรับดูเมนูเฉพาะหมวดหมู่
Route::get('/menu/{table_number}/{category_id}', [MenuController::class, 'showMenuByCategory'])->name('menu.category');

Route::get('/menu/{table}/{category}', [MenuController::class, 'showCategory'])
    ->name('menu.category');
Route::get('/order/summary/{table_number}', [MenuController::class, 'showOrderSummary'])->name('order.summary');

