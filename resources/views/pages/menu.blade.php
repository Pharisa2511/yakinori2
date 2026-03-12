{{-- ในไฟล์ pages/menu.blade.php --}}
@extends('layouts.main')

@section('content')
    {{-- ตัวแม่: ต้องเพิ่ม align-items: flex-start; เพื่อหยุดการยืด --}}
    <div style="display: flex; flex-wrap: wrap; gap: 20px; align-items: flex-start;">
        @foreach ($items as $item)
            @include('components.menu-card', ['item' => $item])

        @endforeach

    </div>
@endsection
