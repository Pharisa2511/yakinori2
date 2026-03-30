<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showMenu($table_number)
    {
        $categories = Category::all();
        $recommended = Menu::inRandomOrder()->limit(4)->get();

        return view('pages.main', compact('table_number', 'categories', 'recommended'));
    }

    public function index()
    {
        $tables = Table::query()
            ->orderBy('table_number')
            ->get();

        return view('pages.welcome', compact('tables'));
    }

    public function selectTable(Request $request)
    {
        return redirect('/menu/' . $request->table);
    }

    public function staffLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($credentials['username'] !== 'A' || $credentials['password'] !== '1234') {
            return redirect('/')->with('staff_error', 'คุณไม่ใช่พนักงาน');
        }

        $request->session()->put('staff_logged_in', true);

        return redirect()->route('staff.history');
    }

    public function staffHistory(Request $request)
    {
        if (!$request->session()->get('staff_logged_in')) {
            return redirect('/')->with('staff_error', 'กรุณาเข้าสู่ระบบสำหรับพนักงานก่อน');
        }

        $tables = Table::query()
            ->orderBy('table_number')
            ->get();

        return view('pages.staff-history', compact('tables'));
    }
}
