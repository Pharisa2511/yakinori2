@extends('layouts.main')

@section('content')

    {{-- ส่วนหัวข้อและเส้นขีด --}}
    <div class="recommended-header" style="display: flex; align-items: center; gap: 15px; margin: 20px 0; margin-left: 20px;">
        <h1 style="margin: 0; white-space: nowrap; font-size: 24px;">เมนูแนะนำ</h1>
        <div style="display: flex; flex-direction: row; gap: 4px; width: 200px;">
            <div style="height: 2px; background-color: #ff6600; width: 100%;"></div>
            <div style="height: 2px; background-color: #ff6600; width: 100%;"></div>
        </div>
    </div>

    {{-- ส่วนแสดงรายการเมนู (วนลูปแค่ครั้งเดียว) --}}
    @if (isset($recommended) && $recommended->isNotEmpty())
        {{-- ในหน้า pages/main.blade.php หรือ menu.blade.php --}}
        <div class="recommended-list" style="display: flex; gap: 20px; padding: 20px; overflow-x: auto;">
            @foreach ($recommended as $item)
                @include('components.menu-card', ['item' => $item])
            @endforeach
        </div>
    @else
        <p style="padding: 20px;">ไม่มีเมนูแนะนำในขณะนี้</p>
    @endif

@endsection
