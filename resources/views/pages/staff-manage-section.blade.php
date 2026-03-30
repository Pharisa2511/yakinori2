@extends('layouts.guest')

@php
    $sectionConfig = [
        'category' => [
            'title' => 'Manage Category',
            'back' => route('staff.manage.categories'),
            'create' => route('staff.categories.store'),
            'search_key' => 'category_search',
        ],
        'menu' => [
            'title' => 'Manage Menu',
            'back' => route('staff.manage.menus'),
            'create' => route('staff.menus.store'),
            'search_key' => 'menu_search',
        ],
        'table' => [
            'title' => 'Manage Table',
            'back' => route('staff.manage.tables'),
            'create' => route('staff.tables.store'),
            'search_key' => 'table_search',
        ],
        'menuoption' => [
            'title' => 'Manage MenuOption',
            'back' => route('staff.manage.menu-options'),
            'create' => route('staff.menu-options.store'),
            'search_key' => 'menu_option_search',
        ],
    ][$section];
@endphp

@section('content')
<main class="guest-shell">
    <div class="container">
        <section class="hero-panel overflow-hidden">
            <div class="d-flex justify-content-between align-items-center gap-3 p-4 p-lg-5 border-bottom"
                style="border-color: rgba(242, 208, 139, 0.12) !important;">
                <div>
                    <p class="hero-kicker mb-2">Staff Only</p>
                    <h1 class="hero-title display-6 mb-0">{{ $sectionConfig['title'] }}</h1>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('staff.manage') }}" class="btn btn-yk-outline rounded-4 px-4 py-3">All Sections</a>
                    <a href="{{ route('staff.history') }}" class="btn btn-yk-outline rounded-4 px-4 py-3">Back</a>
                </div>
            </div>

            @if (session('success'))
                <div class="p-4 pb-0"><div class="alert alert-success rounded-4 mb-0">{{ session('success') }}</div></div>
            @endif
            @if ($errors->any())
                <div class="p-4 pb-0"><div class="alert alert-danger rounded-4 mb-0">{{ $errors->first() }}</div></div>
            @endif

            <div class="p-4 p-lg-5">
                <style>
                    .icon-action-btn {
                        width: 38px;
                        height: 38px;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 999px;
                        font-weight: 700;
                        line-height: 1;
                    }

                    .panel-dropdown {
                        min-width: min(720px, 88vw);
                        padding: 1rem;
                        background: rgba(24, 14, 13, 0.98);
                        border: 1px solid rgba(242, 208, 139, 0.14);
                        border-radius: 1rem;
                    }

                    .panel-dropdown .dropdown-header {
                        color: var(--yk-gold);
                        padding: 0 0 0.75rem 0;
                        font-size: 0.95rem;
                    }

                    .panel-dropdown .form-control,
                    .panel-dropdown .form-select {
                        color: #fff2d6 !important;
                        caret-color: #fff2d6;
                        background-color: rgba(255, 255, 255, 0.08) !important;
                        border-color: rgba(242, 208, 139, 0.18) !important;
                    }

                    .panel-dropdown .form-control::placeholder {
                        color: rgba(255, 242, 214, 0.55) !important;
                    }

                    .panel-dropdown .form-control:focus,
                    .panel-dropdown .form-select:focus {
                        color: #fff7e7 !important;
                        background-color: rgba(255, 255, 255, 0.12) !important;
                        border-color: rgba(242, 208, 139, 0.42) !important;
                        box-shadow: 0 0 0 0.2rem rgba(242, 208, 139, 0.14) !important;
                    }

                    .panel-dropdown .form-select option {
                        color: #fff2d6;
                        background-color: #2a1916;
                    }

                    .menu-thumb {
                        width: 56px;
                        height: 56px;
                        object-fit: cover;
                        border-radius: 0.9rem;
                        border: 1px solid rgba(242, 208, 139, 0.16);
                    }
                </style>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <div class="dropdown">
                        <button class="btn btn-yk-primary rounded-4 px-4 py-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Add
                        </button>
                        <div class="dropdown-menu panel-dropdown">
                            <div class="dropdown-header">Add New</div>
                            @if ($section === 'category')
                                <form method="POST" action="{{ route('staff.categories.store') }}" class="row g-3">
                                    @csrf
                                    <div class="col-md-10"><input name="category_name" class="form-control rounded-4 py-3" placeholder="Category name" required></div>
                                    <div class="col-md-2"><button class="btn btn-yk-primary rounded-4 py-3 w-100">Save</button></div>
                                </form>
                            @elseif ($section === 'menu')
                                <form method="POST" action="{{ route('staff.menus.store') }}" class="row g-3" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-2"><input name="menu_id" class="form-control rounded-4 py-3 menu-id-input" placeholder="M701" value="M" inputmode="numeric" pattern="^M\d+$" required></div>
                                    <div class="col-md-3"><input name="menu_name" class="form-control rounded-4 py-3" placeholder="Menu name" required></div>
                                    <div class="col-md-2"><input name="price" type="number" step="0.01" min="0" class="form-control rounded-4 py-3" placeholder="Price" required></div>
                                    <div class="col-md-2"><select name="status" class="form-select rounded-4 py-3"><option value="available">available</option><option value="unavailable">unavailable</option></select></div>
                                    <div class="col-md-3"><select name="category_id" class="form-select rounded-4 py-3" required>@foreach($categories as $category)<option value="{{ $category->category_id }}">{{ $category->category_name }}</option>@endforeach</select></div>
                                    <div class="col-md-10"><input name="image_file" type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control rounded-4 py-3"></div>
                                    <div class="col-md-2"><button class="btn btn-yk-primary rounded-4 py-3 w-100">Save</button></div>
                                </form>
                            @elseif ($section === 'table')
                                <form method="POST" action="{{ route('staff.tables.store') }}" class="row g-3">
                                    @csrf
                                    <div class="col-md-4"><input name="table_number" type="number" min="1" class="form-control rounded-4 py-3" placeholder="11" required></div>
                                    <div class="col-md-6"><select name="status" class="form-select rounded-4 py-3" required><option value="available">available</option><option value="unavailable">unavailable</option></select></div>
                                    <div class="col-md-2"><button class="btn btn-yk-primary rounded-4 py-3 w-100">Save</button></div>
                                </form>
                            @else
                                <form method="POST" action="{{ route('staff.menu-options.store') }}" class="row g-3">
                                    @csrf
                                    <div class="col-md-3"><input name="option_id" class="form-control rounded-4 py-3 option-id-input" placeholder="o10104" value="o" inputmode="numeric" pattern="^o\d+$" required></div>
                                    <div class="col-md-3"><input name="option_name" class="form-control rounded-4 py-3" placeholder="Option name" required></div>
                                    <div class="col-md-2"><input name="extra_price" type="number" min="0" step="0.01" class="form-control rounded-4 py-3" value="0" required></div>
                                    <div class="col-md-2"><select name="menu_id" class="form-select rounded-4 py-3" required>@foreach($menus as $menu)<option value="{{ $menu->menu_id }}">{{ $menu->menu_name }}</option>@endforeach</select></div>
                                    <div class="col-md-2"><button class="btn btn-yk-primary rounded-4 py-3 w-100">Save</button></div>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-yk-outline rounded-4 px-4 py-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Filter
                        </button>
                        <div class="dropdown-menu panel-dropdown">
                            <div class="dropdown-header">Filter Data</div>
                            @if ($section === 'category')
                                <form method="GET" action="{{ route('staff.manage.categories') }}" class="row g-3">
                                    <div class="col-md-8">
                                        <select name="category_search" class="form-select rounded-4 py-3">
                                            <option value="">All Categories</option>
                                            @foreach($records as $category)
                                                <option value="{{ $category->category_id }}" @selected(request('category_search') === $category->category_id)>{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2"><button class="btn btn-yk-outline rounded-4 py-3 w-100">Apply</button></div>
                                    <div class="col-md-2"><a href="{{ route('staff.manage.categories') }}" class="btn btn-outline-light rounded-4 py-3 w-100">Reset</a></div>
                                </form>
                            @elseif ($section === 'menu')
                                <form method="GET" action="{{ route('staff.manage.menus') }}" class="row g-3">
                                    <div class="col-md-4"><select name="menu_search" class="form-select rounded-4 py-3"><option value="">All Menus</option>@foreach($records as $menu)<option value="{{ $menu->menu_id }}" @selected(request('menu_search') === $menu->menu_id)>{{ $menu->menu_name }}</option>@endforeach</select></div>
                                    <div class="col-md-3"><select name="menu_category_id" class="form-select rounded-4 py-3"><option value="">All Categories</option>@foreach($categories as $category)<option value="{{ $category->category_id }}" @selected(request('menu_category_id') === $category->category_id)>{{ $category->category_name }}</option>@endforeach</select></div>
                                    <div class="col-md-3"><select name="menu_status" class="form-select rounded-4 py-3"><option value="">All Status</option><option value="available" @selected(request('menu_status') === 'available')>available</option><option value="unavailable" @selected(request('menu_status') === 'unavailable')>unavailable</option></select></div>
                                    <div class="col-md-1"><button class="btn btn-yk-outline rounded-4 py-3 w-100">Apply</button></div>
                                    <div class="col-md-1"><a href="{{ route('staff.manage.menus') }}" class="btn btn-outline-light rounded-4 py-3 w-100">Reset</a></div>
                                </form>
                            @elseif ($section === 'table')
                                <form method="GET" action="{{ route('staff.manage.tables') }}" class="row g-3">
                                    <div class="col-md-6"><select name="table_search" class="form-select rounded-4 py-3"><option value="">All Tables</option>@foreach($records as $table)<option value="{{ $table->table_id }}" @selected(request('table_search') === $table->table_id)>Table {{ $table->table_number }}</option>@endforeach</select></div>
                                    <div class="col-md-4"><select name="table_status" class="form-select rounded-4 py-3"><option value="">All Status</option>@foreach($records->pluck('status')->unique() as $status)<option value="{{ $status }}" @selected(request('table_status') === $status)>{{ $status }}</option>@endforeach</select></div>
                                    <div class="col-md-1"><button class="btn btn-yk-outline rounded-4 py-3 w-100">Apply</button></div>
                                    <div class="col-md-1"><a href="{{ route('staff.manage.tables') }}" class="btn btn-outline-light rounded-4 py-3 w-100">Reset</a></div>
                                </form>
                            @else
                                <form method="GET" action="{{ route('staff.manage.menu-options') }}" class="row g-3">
                                    <div class="col-md-5"><select name="menu_option_search" class="form-select rounded-4 py-3"><option value="">All Options</option>@foreach($records as $option)<option value="{{ $option->option_id }}" @selected(request('menu_option_search') === $option->option_id)>{{ $option->option_id }} - {{ $option->option_name }}</option>@endforeach</select></div>
                                    <div class="col-md-5"><select name="option_menu_id" class="form-select rounded-4 py-3"><option value="">All Menus</option>@foreach($menus as $menu)<option value="{{ $menu->menu_id }}" @selected(request('option_menu_id') === $menu->menu_id)>{{ $menu->menu_name }}</option>@endforeach</select></div>
                                    <div class="col-md-1"><button class="btn btn-yk-outline rounded-4 py-3 w-100">Apply</button></div>
                                    <div class="col-md-1"><a href="{{ route('staff.manage.menu-options') }}" class="btn btn-outline-light rounded-4 py-3 w-100">Reset</a></div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="hero-panel-soft p-4">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                @if ($section === 'category')
                                    <tr><th>ID</th><th>Name</th><th class="text-end">Actions</th></tr>
                                @elseif ($section === 'menu')
                                    <tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Status</th><th>Image</th><th class="text-end">Actions</th></tr>
                                @elseif ($section === 'table')
                                    <tr><th>ID</th><th>Number</th><th>Status</th><th class="text-end">Actions</th></tr>
                                @else
                                    <tr><th>ID</th><th>Name</th><th>Menu</th><th>Extra</th><th class="text-end">Actions</th></tr>
                                @endif
                            </thead>
                            <tbody>
                                @forelse ($records as $record)
                                    @if ($section === 'category')
                                        <tr>
                                            <td class="fw-semibold">{{ $record->category_id }}</td>
                                            <td>{{ $record->category_name }}</td>
                                            <td class="text-end">
                                                <div class="d-inline-flex gap-2">
                                                    <button class="btn btn-sm btn-yk-outline rounded-pill px-3 edit-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#edit-{{ $section }}-{{ $record->category_id }}">Edit</button>
                                                    <form method="POST" action="{{ route('staff.categories.destroy', $record->category_id) }}" id="delete-category-{{ $record->category_id }}">@csrf @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete-button" data-delete-form="delete-category-{{ $record->category_id }}" data-delete-label="category {{ $record->category_name }}">Del</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="collapse edit-panel" id="edit-{{ $section }}-{{ $record->category_id }}">
                                            <td colspan="3" class="pt-0 border-0">
                                                <form method="POST" action="{{ route('staff.categories.update', $record->category_id) }}" class="hero-panel-soft p-3 d-flex gap-2 align-items-center">
                                                    @csrf @method('PUT')
                                                    <span class="text-muted-yk small">Edit {{ $record->category_id }}</span>
                                                    <input name="category_name" class="form-control rounded-4 py-2" value="{{ $record->category_name }}" required>
                                                    <button class="btn btn-sm btn-yk-primary rounded-4 px-3">Save</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @elseif ($section === 'menu')
                                        <tr>
                                            <td class="fw-semibold">{{ $record->menu_id }}</td>
                                            <td>{{ $record->menu_name }}</td>
                                            <td>{{ optional($categories->firstWhere('category_id', $record->category_id))->category_name ?? $record->category_id }}</td>
                                            <td>{{ number_format($record->price, 2) }}</td>
                                            <td>{{ $record->status }}</td>
                                            <td>
                                                @if ($record->image_blob)
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ route('menu.image', ['menu_id' => $record->menu_id]) }}" alt="{{ $record->menu_name }}" class="menu-thumb">
                                                    </div>
                                                @else
                                                    <span class="text-muted-yk small">No image</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="d-inline-flex gap-2">
                                                    <button class="btn btn-sm btn-yk-outline rounded-pill px-3 edit-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#edit-{{ $section }}-{{ $record->menu_id }}">Edit</button>
                                                    <form method="POST" action="{{ route('staff.menus.destroy', $record->menu_id) }}" id="delete-menu-{{ $record->menu_id }}">@csrf @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete-button" data-delete-form="delete-menu-{{ $record->menu_id }}" data-delete-label="menu {{ $record->menu_name }}">Del</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="collapse edit-panel" id="edit-{{ $section }}-{{ $record->menu_id }}">
                                            <td colspan="7" class="pt-0 border-0">
                                                <form method="POST" action="{{ route('staff.menus.update', $record->menu_id) }}" class="hero-panel-soft p-3 row g-2 align-items-center" enctype="multipart/form-data">
                                                    @csrf @method('PUT')
                                                    <div class="col-md-3"><input name="menu_name" class="form-control rounded-4 py-2" value="{{ $record->menu_name }}" required></div>
                                                    <div class="col-md-2"><select name="category_id" class="form-select rounded-4 py-2">@foreach($categories as $category)<option value="{{ $category->category_id }}" @selected($record->category_id === $category->category_id)>{{ $category->category_name }}</option>@endforeach</select></div>
                                                    <div class="col-md-2"><input name="price" type="number" min="0" step="0.01" class="form-control rounded-4 py-2" value="{{ $record->price }}" required></div>
                                                    <div class="col-md-2"><select name="status" class="form-select rounded-4 py-2"><option value="available" @selected($record->status === 'available')>available</option><option value="unavailable" @selected($record->status === 'unavailable')>unavailable</option></select></div>
                                                    <div class="col-md-2">
                                                        @if ($record->image_blob)
                                                            <div class="d-flex align-items-center mb-2">
                                                                <img src="{{ route('menu.image', ['menu_id' => $record->menu_id]) }}" alt="{{ $record->menu_name }}" class="menu-thumb">
                                                            </div>
                                                        @endif
                                                        <input name="image_file" type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control rounded-4 py-2">
                                                    </div>
                                                    <div class="col-md-1"><button class="btn btn-sm btn-yk-primary rounded-4 px-3 w-100">Save</button></div>
                                                </form>
                                            </td>
                                        </tr>
                                    @elseif ($section === 'table')
                                        <tr>
                                            <td class="fw-semibold">{{ $record->table_id }}</td>
                                            <td>{{ $record->table_number }}</td>
                                            <td>{{ $record->status }}</td>
                                            <td class="text-end">
                                                <div class="d-inline-flex gap-2">
                                                    <button class="btn btn-sm btn-yk-outline rounded-pill px-3 edit-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#edit-{{ $section }}-{{ $record->table_id }}">Edit</button>
                                                    <form method="POST" action="{{ route('staff.tables.destroy', $record->table_id) }}" id="delete-table-{{ $record->table_id }}">@csrf @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete-button" data-delete-form="delete-table-{{ $record->table_id }}" data-delete-label="table {{ $record->table_number }}">Del</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="collapse edit-panel" id="edit-{{ $section }}-{{ $record->table_id }}">
                                            <td colspan="4" class="pt-0 border-0">
                                                <form method="POST" action="{{ route('staff.tables.update', $record->table_id) }}" class="hero-panel-soft p-3 row g-2 align-items-center">
                                                    @csrf @method('PUT')
                                                    <div class="col-md-3"><input name="table_number" type="number" min="1" class="form-control rounded-4 py-2" value="{{ $record->table_number }}" required></div>
                                                    <div class="col-md-7"><select name="status" class="form-select rounded-4 py-2" required><option value="available" @selected($record->status === 'available')>available</option><option value="unavailable" @selected($record->status === 'unavailable')>unavailable</option></select></div>
                                                    <div class="col-md-2"><button class="btn btn-sm btn-yk-primary rounded-4 px-3 w-100">Save</button></div>
                                                </form>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="fw-semibold">{{ $record->option_id }}</td>
                                            <td>{{ $record->option_name }}</td>
                                            <td>{{ optional($menus->firstWhere('menu_id', $record->menu_id))->menu_name ?? $record->menu_id }}</td>
                                            <td>{{ number_format($record->extra_price, 2) }}</td>
                                            <td class="text-end">
                                                <div class="d-inline-flex gap-2">
                                                    <button class="btn btn-sm btn-yk-outline rounded-pill px-3 edit-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#edit-{{ $section }}-{{ $record->option_id }}">Edit</button>
                                                    <form method="POST" action="{{ route('staff.menu-options.destroy', $record->option_id) }}" id="delete-option-{{ $record->option_id }}">@csrf @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete-button" data-delete-form="delete-option-{{ $record->option_id }}" data-delete-label="menu option {{ $record->option_name }}">Del</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="collapse edit-panel" id="edit-{{ $section }}-{{ $record->option_id }}">
                                            <td colspan="5" class="pt-0 border-0">
                                                <form method="POST" action="{{ route('staff.menu-options.update', $record->option_id) }}" class="hero-panel-soft p-3 row g-2 align-items-center">
                                                    @csrf @method('PUT')
                                                    <div class="col-md-4"><input name="option_name" class="form-control rounded-4 py-2" value="{{ $record->option_name }}" required></div>
                                                    <div class="col-md-3"><select name="menu_id" class="form-select rounded-4 py-2">@foreach($menus as $menu)<option value="{{ $menu->menu_id }}" @selected($record->menu_id === $menu->menu_id)>{{ $menu->menu_name }}</option>@endforeach</select></div>
                                                    <div class="col-md-3"><input name="extra_price" type="number" min="0" step="0.01" class="form-control rounded-4 py-2" value="{{ $record->extra_price }}" required></div>
                                                    <div class="col-md-2"><button class="btn btn-sm btn-yk-primary rounded-4 px-3 w-100">Save</button></div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr><td colspan="7" class="text-center py-4">No data found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content hero-panel border-0">
            <div class="modal-header border-bottom" style="border-color: rgba(242, 208, 139, 0.12) !important;">
                <h2 class="modal-title fs-4 hero-title">Confirm Delete</h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-0 text-muted-yk" id="deleteConfirmText">Delete this item?</p>
            </div>
            <div class="modal-footer border-0 px-4 pb-4">
                <button type="button" class="btn btn-yk-outline rounded-4 px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger rounded-4 px-4" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const MAX_MENU_IMAGE_BYTES = 1900 * 1024;

    async function compressImageFile(file) {
        if (!file || file.size <= MAX_MENU_IMAGE_BYTES) {
            return file;
        }

        const dataUrl = await new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = () => resolve(reader.result);
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });

        const image = await new Promise((resolve, reject) => {
            const img = new Image();
            img.onload = () => resolve(img);
            img.onerror = reject;
            img.src = dataUrl;
        });

        let width = image.width;
        let height = image.height;
        const maxDimension = 1400;

        if (Math.max(width, height) > maxDimension) {
            const ratio = maxDimension / Math.max(width, height);
            width = Math.max(Math.round(width * ratio), 1);
            height = Math.max(Math.round(height * ratio), 1);
        }

        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.width = width;
        canvas.height = height;
        context.drawImage(image, 0, 0, width, height);

        let quality = 0.82;
        let blob = await new Promise((resolve) => canvas.toBlob(resolve, 'image/jpeg', quality));

        while (blob && blob.size > MAX_MENU_IMAGE_BYTES && quality > 0.45) {
            quality -= 0.08;
            blob = await new Promise((resolve) => canvas.toBlob(resolve, 'image/jpeg', quality));
        }

        if (!blob) {
            return file;
        }

        return new File([blob], file.name.replace(/\.[^.]+$/, '') + '.jpg', {
            type: 'image/jpeg',
            lastModified: Date.now(),
        });
    }

    document.addEventListener('click', function (event) {
        const openPanels = document.querySelectorAll('.edit-panel.show');

        openPanels.forEach(function (panel) {
            if (panel.contains(event.target)) {
                return;
            }

            const toggle = document.querySelector('[data-bs-target="#' + panel.id + '"]');
            if (toggle && toggle.contains(event.target)) {
                return;
            }

            bootstrap.Collapse.getOrCreateInstance(panel, { toggle: false }).hide();
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const deleteModalElement = document.getElementById('deleteConfirmModal');
        const deleteModal = new bootstrap.Modal(deleteModalElement);
        const deleteText = document.getElementById('deleteConfirmText');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        let pendingDeleteForm = null;

        document.querySelectorAll('.menu-id-input').forEach(function (input) {
            if (!input.value) {
                input.value = 'M';
            }

            input.addEventListener('focus', function () {
                if (!input.value) {
                    input.value = 'M';
                }
            });

            input.addEventListener('input', function () {
                let value = input.value.toUpperCase().replace(/[^A-Z0-9]/g, '');

                if (!value.startsWith('M')) {
                    value = 'M' + value.replace(/^M*/, '');
                }

                input.value = value;
            });
        });

        document.querySelectorAll('.option-id-input').forEach(function (input) {
            if (!input.value) {
                input.value = 'o';
            }

            input.addEventListener('focus', function () {
                if (!input.value) {
                    input.value = 'o';
                }
            });

            input.addEventListener('input', function () {
                let value = input.value.toLowerCase().replace(/[^a-z0-9]/g, '');

                if (!value.startsWith('o')) {
                    value = 'o' + value.replace(/^o*/, '');
                }

                if (value === '') {
                    value = 'o';
                }

                input.value = value;
            });
        });

        document.querySelectorAll('input[name="image_file"]').forEach(function (input) {
            input.addEventListener('change', async function () {
                const [file] = input.files || [];

                if (!file) {
                    return;
                }

                const processedFile = await compressImageFile(file);

                if (processedFile === file) {
                    return;
                }

                const transfer = new DataTransfer();
                transfer.items.add(processedFile);
                input.files = transfer.files;
            });
        });

        document.querySelectorAll('.delete-button').forEach(function (button) {
            button.addEventListener('click', function () {
                pendingDeleteForm = document.getElementById(button.dataset.deleteForm);
                deleteText.textContent = 'Delete ' + button.dataset.deleteLabel + '?';
                deleteModal.show();
            });
        });

        confirmDeleteButton.addEventListener('click', function () {
            if (pendingDeleteForm) {
                pendingDeleteForm.submit();
            }
        });
    });
</script>
@endpush

