<?php

use Illuminate\Support\Facades\Route;

// ตัวอย่างที่ถูกต้อง
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
