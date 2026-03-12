<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Category;
use App\Models\Menu; // นำเข้า Model Menu เพื่อให้เรียกใช้ได้ง่ายขึ้น

class HomeController extends Controller
{

    // 1. หน้าเมนู (ใช้แสดงอาหาร)
    public function showMenu($table_number)
    {
        $categories = Category::all();
        $recommended = Menu::inRandomOrder()->limit(4)->get();
        return view('pages.main', compact('table_number', 'categories', 'recommended'));
    }

    public function index()
    {
        // ดึงข้อมูลโต๊ะทั้งหมดจาก Model Table เรียงตามลำดับเลขโต๊ะ
        $tables = Table::all();
        // ส่งตัวแปร $tables ไปที่ไฟล์หน้าเว็บ
        return view('pages.welcome', compact('tables'));
    }

    public function selectTable(Request $request)
    {
        $table = $request->table;

        // แก้จาก redirect('/menu?table=' . $table)
        // เป็นการส่งไปที่ URL: /menu/2 โดยตรง
        return redirect('/menu/' . $table);
    }
}
