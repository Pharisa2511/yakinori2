<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

// 1. หน้าแรก (เลือกโต๊ะ)
Route::get('/', [HomeController::class, 'welcomePage']);

// 2. กลุ่มหน้าเมนู (Dashboard ของลูกค้า)
// หน้าหลักที่โชว์เมนูแนะนำ
Route::get('/menu/{table_number}', [HomeController::class, 'showMenu'])->name('menu.show');

// หน้าแสดงเมนูตามหมวดหมู่
Route::get('/menu/{table_number}/{category_id}', [MenuController::class, 'showMenuByCategory'])->name('menu.category');

// 3. หน้าสรุปรายการอาหาร
Route::get('/order/summary/{table_number}', [MenuController::class, 'showOrderSummary'])->name('order.summary');
