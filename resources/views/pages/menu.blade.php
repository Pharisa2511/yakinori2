@extends('layouts.main')

@section('content')
    <section class="mt-n2 pt-2">
        <div class="d-flex align-items-center gap-3 mb-4">
            <h1 class="section-title mb-0">{{ $currentCategory->category_name ?? 'Menu' }}</h1>
            <div class="section-lines d-flex gap-2">
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($items as $item)
                <div class="col-12 col-sm-6 col-xl-3">
                    @include('components.menu-card', ['item' => $item])
                </div>
            @endforeach
        </div>
    </section>
@endsection
