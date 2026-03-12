<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
class HomeController extends Controller
{

    public function index()
    {
        // ดึงข้อมูลโต๊ะทั้งหมดจาก Model Table เรียงตามลำดับเลขโต๊ะ
        $tables = \App\Models\Table::all();

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
