<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function add(Request $request, $table_number)
    {
        $validated = $request->validate([
            'menu_id' => ['required', 'string'],
            'menu_name' => ['required', 'string'],
            'total_price' => ['required', 'numeric'],
            'option_name' => ['nullable', 'string'],
            'option_extra_price' => ['nullable', 'numeric'],
            'note' => ['nullable', 'string'],
        ]);

        $table = Table::where('table_number', $table_number)->first();
        $menu = Menu::query()->select('menu_id')->where('menu_id', $validated['menu_id'])->first();

        if (!$table) {
            return $this->respond($request, false, 'Table not found.', 404);
        }

        if (!$menu) {
            return $this->respond($request, false, 'Menu not found.', 404);
        }

        $cart = $request->session()->get($this->cartKey($table_number), []);
        $cart[] = [
            'menu_id' => $validated['menu_id'],
            'menu_name' => $validated['menu_name'],
            'price' => (float) $validated['total_price'],
            'quantity' => 1,
            'option_name' => $validated['option_name'] ?? null,
            'option_extra_price' => isset($validated['option_extra_price']) ? (float) $validated['option_extra_price'] : 0,
            'note' => $validated['note'] ?? null,
        ];

        $request->session()->put($this->cartKey($table_number), $cart);

        return $this->respond($request, true, 'Added to cart.', 200, [
            'cart_count' => count($cart),
            'table_number' => (int) $table_number,
        ]);
    }

    public function checkout(Request $request, $table_number)
    {
        $validated = $request->validate([
            'payment_method' => ['required', 'in:QR,cash,credit'],
        ]);

        $table = Table::where('table_number', $table_number)->first();

        if (!$table) {
            return back()->with('error', 'Table not found.');
        }

        $cart = $request->session()->get($this->cartKey($table_number), []);

        if (empty($cart)) {
            return back()->with('error', 'No items to checkout.');
        }

        DB::transaction(function () use ($cart, $table, $validated) {
            $orderId = DB::table('orders')->insertGetId([
                'order_datetime' => now(),
                'status' => 'pending',
                'total_price' => 0,
                'table_id' => $table->table_id,
            ], 'order_id');

            foreach ($cart as $item) {
                $itemNote = $item['note'];

                if (!empty($item['option_name'])) {
                    $optionLine = 'Option: ' . $item['option_name'];
                    $itemNote = $itemNote ? $optionLine . PHP_EOL . $itemNote : $optionLine;
                }

                DB::table('order_items')->insert([
                    'note' => $itemNote,
                    'status' => 'ordered',
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'menu_id' => $item['menu_id'],
                    'order_id' => $orderId,
                ]);
            }

            $order = DB::table('orders')->where('order_id', $orderId)->first();

            DB::table('payments')->insert([
                'payment_datetime' => now(),
                'payment_method' => $validated['payment_method'],
                'amount' => $order->total_price,
                'status' => 'paid',
                'order_id' => $orderId,
            ]);

            DB::table('orders')
                ->where('order_id', $orderId)
                ->update(['status' => 'paid']);
        });

        $request->session()->forget($this->cartKey($table_number));

        return redirect()
            ->route('order.history', ['table_number' => $table_number])
            ->with('success', 'Checkout completed successfully.');
    }

    public function remove(Request $request, $table_number)
    {
        $validated = $request->validate([
            'index' => ['required', 'integer', 'min:0'],
        ]);

        $cart = $request->session()->get($this->cartKey($table_number), []);

        if (array_key_exists($validated['index'], $cart)) {
            unset($cart[$validated['index']]);
            $request->session()->put($this->cartKey($table_number), array_values($cart));
        }

        return back()->with('success', 'Item removed from cart.');
    }

    public function updateQuantity(Request $request, $table_number)
    {
        $validated = $request->validate([
            'index' => ['required', 'integer', 'min:0'],
            'action' => ['required', 'in:increase,decrease'],
        ]);

        $cart = $request->session()->get($this->cartKey($table_number), []);

        if (!array_key_exists($validated['index'], $cart)) {
            return back()->with('error', 'Cart item not found.');
        }

        if ($validated['action'] === 'increase') {
            $cart[$validated['index']]['quantity']++;
        } elseif (($cart[$validated['index']]['quantity'] ?? 1) > 1) {
            $cart[$validated['index']]['quantity']--;
        } else {
            unset($cart[$validated['index']]);
            $cart = array_values($cart);
            $request->session()->put($this->cartKey($table_number), $cart);

            return back()->with('success', 'Item removed from cart.');
        }

        $request->session()->put($this->cartKey($table_number), $cart);

        return back()->with('success', 'Cart updated successfully.');
    }

    private function respond(Request $request, bool $ok, string $message, int $status, array $extra = [])
    {
        if ($request->expectsJson()) {
            return response()->json(array_merge([
                'success' => $ok,
                'message' => $message,
            ], $extra), $status);
        }

        return back()->with($ok ? 'success' : 'error', $message);
    }

    private function cartKey($table_number): string
    {
        return 'cart.table.' . $table_number;
    }
}
