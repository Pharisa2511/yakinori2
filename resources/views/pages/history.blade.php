@extends('layouts.guest')

@section('content')
    <main class="guest-shell">
        <div class="container" style="max-width: min(65vw, 980px);">
            <section class="hero-panel overflow-hidden">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 p-4 p-lg-5 border-bottom"
                    style="border-color: rgba(242, 208, 139, 0.12) !important;">
                    <div>
                        <p class="hero-kicker mb-2">Table {{ $table_number }}</p>
                        <h1 class="hero-title display-5 mb-0">Receipt History</h1>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('order.summary', ['table_number' => $table_number]) }}"
                            class="btn btn-yk-outline rounded-4 px-4 py-3">
                            Current Cart
                        </a>
                        <a href="{{ route('staff.history') }}" class="btn btn-yk-outline rounded-4 px-4 py-3">
                            All Tables
                        </a>
                    </div>
                </div>

                @if (session('success'))
                    <div class="px-4 px-lg-5 pt-4">
                        <div class="alert alert-success rounded-4 mb-0">{{ session('success') }}</div>
                    </div>
                @endif

                <div class="p-4 p-lg-5">
                    @if ($orders->isEmpty())
                        <div class="hero-panel-soft p-4 p-lg-5">
                            <h2 class="h3 text-gold mb-3">Receipt History</h2>
                            <p class="mb-0 fs-5">No receipt history for table {{ $table_number }} yet.</p>
                        </div>
                    @else
                        <div class="d-grid gap-4">
                            @foreach ($orders as $order)
                                <article class="hero-panel-soft overflow-hidden">
                                    <div class="row g-0 border-bottom"
                                        style="border-color: rgba(242, 208, 139, 0.1) !important;">
                                        <div class="col-lg-7 p-4">
                                            <h2 class="hero-title h2 mb-3">Receipt #{{ $order->order_id }}</h2>
                                            <p class="mb-2">Receipt Status: {{ $order->order_status }}</p>
                                            <p class="mb-2 text-muted-yk">Payment Method: {{ $order->payment_method ?? '-' }}</p>
                                            <p class="mb-0 text-muted-yk">Paid At: {{ $order->payment_datetime ?? '-' }}</p>
                                        </div>
                                        <div class="col-lg-5 p-4 text-lg-end">
                                            <p class="mb-2 text-muted-yk">Receipt Date: {{ $order->order_datetime }}</p>
                                            <div class="display-6 text-gold fw-semibold">
                                                ฿{{ number_format($order->total_price, 2) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-4">
                                        <div class="table-responsive">
                                            <table class="table align-middle mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Menu</th>
                                                        <th class="text-end">Price</th>
                                                        <th class="text-center">Qty</th>
                                                        <th class="text-end">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (($orderItems[$order->order_id] ?? collect()) as $item)
                                                        <tr>
                                                            <td class="py-4">
                                                                <div class="d-flex align-items-center gap-3">
                                                                    <div class="rounded-4 overflow-hidden flex-shrink-0"
                                                                        style="width: 92px; height: 76px; background: rgba(255,255,255,0.08);">
                                                                        <img src="{{ route('menu.image', ['menu_id' => $item->menu_id]) }}"
                                                                            alt="{{ $item->menu_name }}"
                                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                                    </div>
                                                                    <div>
                                                                        <div class="fs-5">{{ $item->menu_name }}</div>
                                                                        @if ($item->note)
                                                                            <div class="text-muted-yk small mt-1">{{ $item->note }}</div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end py-4">฿{{ number_format($item->price, 2) }}</td>
                                                            <td class="text-center py-4">x{{ $item->quantity }}</td>
                                                            <td class="text-end py-4 fw-semibold text-gold">
                                                                ฿{{ number_format($item->price * $item->quantity, 2) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </main>
@endsection
