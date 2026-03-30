<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StaffManagementController;
use Illuminate\Support\Facades\Route;

// 1. หน้าแรก (เลือกโต๊ะ)
Route::get('/', [HomeController::class, 'index']);
Route::post('/staff/login', [HomeController::class, 'staffLogin'])->name('staff.login');
Route::get('/staff/history', [HomeController::class, 'staffHistory'])->name('staff.history');
Route::get('/staff/manage', [StaffManagementController::class, 'index'])->name('staff.manage');
Route::get('/staff/manage/categories', [StaffManagementController::class, 'categories'])->name('staff.manage.categories');
Route::get('/staff/manage/menus', [StaffManagementController::class, 'menus'])->name('staff.manage.menus');
Route::get('/staff/manage/tables', [StaffManagementController::class, 'tables'])->name('staff.manage.tables');
Route::get('/staff/manage/menu-options', [StaffManagementController::class, 'menuOptions'])->name('staff.manage.menu-options');
Route::post('/staff/categories', [StaffManagementController::class, 'storeCategory'])->name('staff.categories.store');
Route::put('/staff/categories/{category_id}', [StaffManagementController::class, 'updateCategory'])->name('staff.categories.update');
Route::delete('/staff/categories/{category_id}', [StaffManagementController::class, 'destroyCategory'])->name('staff.categories.destroy');
Route::post('/staff/menus', [StaffManagementController::class, 'storeMenu'])->name('staff.menus.store');
Route::put('/staff/menus/{menu_id}', [StaffManagementController::class, 'updateMenu'])->name('staff.menus.update');
Route::delete('/staff/menus/{menu_id}', [StaffManagementController::class, 'destroyMenu'])->name('staff.menus.destroy');
Route::post('/staff/tables', [StaffManagementController::class, 'storeTable'])->name('staff.tables.store');
Route::put('/staff/tables/{table_id}', [StaffManagementController::class, 'updateTable'])->name('staff.tables.update');
Route::delete('/staff/tables/{table_id}', [StaffManagementController::class, 'destroyTable'])->name('staff.tables.destroy');
Route::post('/staff/menu-options', [StaffManagementController::class, 'storeMenuOption'])->name('staff.menu-options.store');
Route::put('/staff/menu-options/{option_id}', [StaffManagementController::class, 'updateMenuOption'])->name('staff.menu-options.update');
Route::delete('/staff/menu-options/{option_id}', [StaffManagementController::class, 'destroyMenuOption'])->name('staff.menu-options.destroy');
// 2. กลุ่มหน้าเมนู (Dashboard ของลูกค้า)
// หน้าหลักที่โชว์เมนูแนะนำ
Route::get('/menu/{table_number}', [HomeController::class, 'showMenu'])->name('menu.show');
Route::get('/menu-image/{menu_id}', [MenuController::class, 'image'])->name('menu.image');

// หน้าแสดงเมนูตามหมวดหมู่
Route::get('/menu/{table_number}/{category_id}', [MenuController::class, 'showMenuByCategory'])->name('menu.category');

// 3. หน้าสรุปรายการอาหาร
Route::get('/order/summary/{table_number}', [MenuController::class, 'showOrderSummary'])->name('order.summary');
Route::get('/order/history/{table_number}', [MenuController::class, 'showOrderHistory'])->name('order.history');

// เพิ่มบรรทัดนี้ลงไป
Route::post('/menu/{table_number}/order/add', [App\Http\Controllers\OrderController::class, 'add'])->name('order.add');
Route::post('/menu/{table_number}/cart/quantity', [App\Http\Controllers\OrderController::class, 'updateQuantity'])->name('order.quantity');
Route::post('/menu/{table_number}/cart/remove', [App\Http\Controllers\OrderController::class, 'remove'])->name('order.remove');
Route::post('/menu/{table_number}/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('order.checkout');
