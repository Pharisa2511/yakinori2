<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuOption;
use App\Models\Table;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffManagementController extends Controller
{
    public function index(Request $request)
    {
        $this->ensureStaff($request);

        return view('pages.staff-manage');
    }

    public function categories(Request $request)
    {
        $this->ensureStaff($request);

        [$records, $categories, $menus] = $this->loadSectionData($request, 'category');

        return view('pages.staff-manage-section', [
            'section' => 'category',
            'records' => $records,
            'categories' => $categories,
            'menus' => $menus,
        ]);
    }

    public function menus(Request $request)
    {
        $this->ensureStaff($request);

        [$records, $categories, $menus] = $this->loadSectionData($request, 'menu');

        return view('pages.staff-manage-section', [
            'section' => 'menu',
            'records' => $records,
            'categories' => $categories,
            'menus' => $menus,
        ]);
    }

    public function tables(Request $request)
    {
        $this->ensureStaff($request);

        [$records, $categories, $menus] = $this->loadSectionData($request, 'table');

        return view('pages.staff-manage-section', [
            'section' => 'table',
            'records' => $records,
            'categories' => $categories,
            'menus' => $menus,
        ]);
    }

    public function menuOptions(Request $request)
    {
        $this->ensureStaff($request);

        [$records, $categories, $menus] = $this->loadSectionData($request, 'menuoption');

        return view('pages.staff-manage-section', [
            'section' => 'menuoption',
            'records' => $records,
            'categories' => $categories,
            'menus' => $menus,
        ]);
    }

    private function loadSectionData(Request $request, string $section): array
    {
        $categories = Category::query()
            ->orderBy('category_id')
            ->orderBy('category_name')
            ->get();
        $menus = Menu::query()
            ->orderByRaw('CAST(SUBSTR(menu_id, 2) AS INTEGER)')
            ->orderBy('menu_name')
            ->get();

        $categoryQuery = Category::query()
            ->orderBy('category_id')
            ->orderBy('category_name');
        if ($request->filled('category_search')) {
            $search = $request->string('category_search')->trim();
            $categoryQuery->where(function ($query) use ($search) {
                $query->where('category_id', 'like', "%{$search}%")
                    ->orWhere('category_name', 'like', "%{$search}%");
            });
        }

        $menuQuery = Menu::query()
            ->orderByRaw('CAST(SUBSTR(menu_id, 2) AS INTEGER)')
            ->orderBy('menu_name');
        if ($request->filled('menu_search')) {
            $search = $request->string('menu_search')->trim();
            $menuQuery->where(function ($query) use ($search) {
                $query->where('menu_id', 'like', "%{$search}%")
                    ->orWhere('menu_name', 'like', "%{$search}%");
            });
        }
        if ($request->filled('menu_category_id')) {
            $menuQuery->where('category_id', $request->string('menu_category_id')->toString());
        }
        if ($request->filled('menu_status')) {
            $menuQuery->where('status', $request->string('menu_status')->toString());
        }

        $tableQuery = Table::query()->orderBy('table_number');
        if ($request->filled('table_search')) {
            $search = $request->string('table_search')->trim();
            $tableQuery->where(function ($query) use ($search) {
                $query->where('table_id', 'like', "%{$search}%")
                    ->orWhere('table_number', 'like', "%{$search}%");
            });
        }
        if ($request->filled('table_status')) {
            $tableQuery->where('status', 'like', '%' . $request->string('table_status')->toString() . '%');
        }

        $menuOptionQuery = MenuOption::query()
            ->orderByRaw('CAST(SUBSTR(option_id, 2) AS INTEGER)')
            ->orderBy('option_name');
        if ($request->filled('menu_option_search')) {
            $search = $request->string('menu_option_search')->trim();
            $menuOptionQuery->where(function ($query) use ($search) {
                $query->where('option_id', 'like', "%{$search}%")
                    ->orWhere('option_name', 'like', "%{$search}%");
            });
        }
        if ($request->filled('option_menu_id')) {
            $menuOptionQuery->where('menu_id', $request->string('option_menu_id')->toString());
        }

        $records = match ($section) {
            'menu' => $menuQuery->get(),
            'table' => $tableQuery->get(),
            'menuoption' => $menuOptionQuery->get(),
            default => $categoryQuery->get(),
        };

        return [$records, $categories, $menus];
    }

    public function storeCategory(Request $request): RedirectResponse
    {
        $this->ensureStaff($request);

        $validated = $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
        ]);

        Category::create([
            'category_name' => $validated['category_name'],
        ]);

        return $this->redirectToSection('category')->with('success', 'Category created successfully.');
    }

    public function updateCategory(Request $request, string $categoryId): RedirectResponse
    {
        $this->ensureStaff($request);

        $validated = $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
        ]);

        Category::where('category_id', $categoryId)->update($validated);

        return $this->redirectToSection('category')->with('success', 'Category updated successfully.');
    }

    public function destroyCategory(Request $request, string $categoryId): RedirectResponse
    {
        $this->ensureStaff($request);

        Category::where('category_id', $categoryId)->delete();

        return $this->redirectToSection('category')->with('success', 'Category deleted successfully.');
    }

    public function storeMenu(Request $request): RedirectResponse
    {
        $this->ensureStaff($request);

        $validated = $request->validate([
            'menu_id' => ['required', 'string', 'max:50', 'regex:/^M\\d+$/', 'unique:menus,menu_id'],
            'menu_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,category_id'],
            'status' => ['required', 'in:available,unavailable'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        Menu::create([
            'menu_id' => $validated['menu_id'],
            'menu_name' => $validated['menu_name'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'status' => $validated['status'],
            ...$this->buildMenuImagePayload($request),
        ]);

        return $this->redirectToSection('menu')->with('success', 'Menu created successfully.');
    }

    public function updateMenu(Request $request, string $menuId): RedirectResponse
    {
        $this->ensureStaff($request);

        $validated = $request->validate([
            'menu_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,category_id'],
            'status' => ['required', 'in:available,unavailable'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $menu = Menu::query()->findOrFail($menuId);

        $menu->update([
            'menu_name' => $validated['menu_name'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'status' => $validated['status'],
            ...$this->buildMenuImagePayload($request, $menu),
        ]);

        return $this->redirectToSection('menu')->with('success', 'Menu updated successfully.');
    }

    public function destroyMenu(Request $request, string $menuId): RedirectResponse
    {
        $this->ensureStaff($request);

        $menu = Menu::query()->findOrFail($menuId);

        $menu->delete();

        return $this->redirectToSection('menu')->with('success', 'Menu deleted successfully.');
    }

    public function storeTable(Request $request): RedirectResponse
    {
        $this->ensureStaff($request);

        $validated = $request->validate([
            'table_number' => ['required', 'integer', 'min:1', 'unique:tables,table_number'],
            'status' => ['required', 'string', 'max:100'],
        ]);

        Table::create($validated);

        return $this->redirectToSection('table')->with('success', 'Table created successfully.');
    }

    public function updateTable(Request $request, string $tableId): RedirectResponse
    {
        $this->ensureStaff($request);

        $validated = $request->validate([
            'table_number' => ['required', 'integer', 'min:1', 'unique:tables,table_number,' . $tableId . ',table_id'],
            'status' => ['required', 'string', 'max:100'],
        ]);

        Table::where('table_id', $tableId)->update($validated);

        return $this->redirectToSection('table')->with('success', 'Table updated successfully.');
    }

    public function destroyTable(Request $request, string $tableId): RedirectResponse
    {
        $this->ensureStaff($request);

        Table::where('table_id', $tableId)->delete();

        return $this->redirectToSection('table')->with('success', 'Table deleted successfully.');
    }

    public function storeMenuOption(Request $request): RedirectResponse
    {
        $this->ensureStaff($request);

        $validated = $request->validate([
            'option_id' => ['required', 'string', 'max:50', 'regex:/^o\\d+$/', 'unique:menu_options,option_id'],
            'option_name' => ['required', 'string', 'max:255'],
            'extra_price' => ['required', 'numeric', 'min:0'],
            'menu_id' => ['required', 'exists:menus,menu_id'],
        ]);

        MenuOption::create($validated);

        return $this->redirectToSection('menuoption')->with('success', 'Menu option created successfully.');
    }

    public function updateMenuOption(Request $request, string $optionId): RedirectResponse
    {
        $this->ensureStaff($request);

        $validated = $request->validate([
            'option_name' => ['required', 'string', 'max:255'],
            'extra_price' => ['required', 'numeric', 'min:0'],
            'menu_id' => ['required', 'exists:menus,menu_id'],
        ]);

        MenuOption::where('option_id', $optionId)->update($validated);

        return $this->redirectToSection('menuoption')->with('success', 'Menu option updated successfully.');
    }

    public function destroyMenuOption(Request $request, string $optionId): RedirectResponse
    {
        $this->ensureStaff($request);

        MenuOption::where('option_id', $optionId)->delete();

        return $this->redirectToSection('menuoption')->with('success', 'Menu option deleted successfully.');
    }

    private function redirectToSection(string $section): RedirectResponse
    {
        return redirect()->route(match ($section) {
            'menu' => 'staff.manage.menus',
            'table' => 'staff.manage.tables',
            'menuoption' => 'staff.manage.menu-options',
            default => 'staff.manage.categories',
        });
    }

    private function ensureStaff(Request $request): void
    {
        abort_unless($request->session()->get('staff_logged_in'), 403);
    }

    private function buildMenuImagePayload(Request $request, ?Menu $menu = null): array
    {
        if (!$request->hasFile('image_file')) {
            return [
                'image_blob' => $menu?->image_blob,
                'image_mime' => $menu?->image_mime,
            ];
        }

        return [
            'image_blob' => file_get_contents($request->file('image_file')->getRealPath()),
            'image_mime' => $request->file('image_file')->getMimeType() ?: 'image/png',
        ];
    }
}

