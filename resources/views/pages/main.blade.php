@extends('layouts.main')

@section('content')
    <section class="mt-n2 pt-2">
        <div class="d-flex align-items-center gap-3 mb-4">
            <h1 class="section-title mb-0">เมนูแนะนำ</h1>
            <div class="section-lines d-flex gap-2">
                <span></span>
                <span></span>
            </div>
        </div>

        @if (isset($recommended) && $recommended->isNotEmpty())
            <div class="row g-4">
                @foreach ($recommended as $item)
                    <div class="col-12 col-sm-6 col-xl-3">
                        @include('components.menu-card', ['item' => $item])
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-light border rounded-4">ยังไม่มีเมนูแนะนำในขณะนี้</div>
        @endif
    </section>
@endsection
