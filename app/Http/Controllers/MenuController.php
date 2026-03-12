<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Menu; // นำเข้า Model Menu เพื่อให้เรียกใช้ได้ง่ายขึ้น
use App\Models\Order;

class MenuController extends Controller
{
    // วางฟังก์ชันของคุณไว้ในคลาสนี้ครับ
    public function showMenu($table_number)
    {
        // ต้องดึงข้อมูลหมวดหมู่มาด้วย
        $categories = Category::all();

        // ต้องใช้ compact('categories') เพื่อส่งไปที่ View
        return view('layouts.main', compact('table_number', 'categories'));
    }

    public function showCategory($table, $category)
    {
        $menus = Menu::where('category_id', $category)->get();
        $categories = Category::all();

        return view('layouts.main', compact('menus', 'categories', 'table'));
    }
    public function showOrderSummary($table_number)
    {

        // 1. ดึงข้อมูลจากฐานข้อมูลตาราง 'orders' โดยตรงตามเงื่อนไข
        $orders = Order::where('table_number', $table_number)
            ->where('status', 'pending')
            ->get();

        // 2. เรียก View ให้ตรงกับตำแหน่งใหม่ที่คุณย้ายไป (pages.summary)
        return view('pages.summary', compact('orders', 'table_number'));
    }
}
