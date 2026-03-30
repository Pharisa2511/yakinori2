<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function showMenu($table_number)
    {
        $categories = Category::all();

        return view('layouts.main', compact('table_number', 'categories'));
    }

    public function showMenuByCategory($table_number, $category_id)
    {
        $categories = Category::all();
        $currentCategory = $categories->firstWhere('category_id', $category_id);
        $items = Menu::with('options')
            ->where('category_id', $category_id)
            ->get();

        return view('pages.menu', compact('table_number', 'categories', 'items', 'category_id', 'currentCategory'));
    }

    public function showOrderSummary($table_number)
    {
        $categories = Category::all();
        $table = Table::where('table_number', $table_number)->first();

        if (!$table) {
            abort(404);
        }

        $cart = collect(session('cart.table.' . $table_number, []));
        $cartTotal = $cart->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('pages.summary', compact('cart', 'cartTotal', 'table_number', 'categories'));
    }

    public function showOrderHistory($table_number)
    {
        $categories = Category::all();
        $table = Table::where('table_number', $table_number)->first();

        if (!$table) {
            abort(404);
        }

        $orders = DB::table('orders')
            ->leftJoin('payments', 'payments.order_id', '=', 'orders.order_id')
            ->where('orders.table_id', $table->table_id)
            ->select(
                'orders.order_id',
                'orders.order_datetime',
                'orders.status as order_status',
                'orders.total_price',
                'payments.payment_method',
                'payments.payment_datetime'
            )
            ->orderByDesc('orders.order_id')
            ->get();

        $orderItems = DB::table('order_items')
            ->join('orders', 'orders.order_id', '=', 'order_items.order_id')
            ->join('menus', 'menus.menu_id', '=', 'order_items.menu_id')
            ->where('orders.table_id', $table->table_id)
            ->select(
                'order_items.order_id',
                'order_items.menu_id',
                'order_items.quantity',
                'order_items.price',
                'order_items.note',
                'order_items.status as item_status',
                'menus.menu_name'
            )
            ->get()
            ->groupBy('order_id');

        return view('pages.history', compact('orders', 'orderItems', 'table_number', 'categories'));
    }

    public function image(string $menu_id): Response
    {
        $menu = Menu::query()
            ->select('menu_id', 'image_blob', 'image_mime')
            ->findOrFail($menu_id);

        if ($menu->image_blob) {
            return response($menu->image_blob, 200, [
                'Content-Type' => $menu->image_mime ?: 'image/png',
                'Cache-Control' => 'public, max-age=86400',
            ]);
        }

        $fallback = 'yakinori.png';

        return response(Storage::disk('public')->get($fallback), 200, [
            'Content-Type' => Storage::disk('public')->mimeType($fallback) ?: 'image/png',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
