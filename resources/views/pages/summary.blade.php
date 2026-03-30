@extends('layouts.guest')

@section('content')
    <main class="guest-shell">
        <div class="container">
            <section class="hero-panel overflow-hidden">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 p-4 p-lg-5 border-bottom"
                    style="border-color: rgba(242, 208, 139, 0.12) !important;">
                    <div>
                        <p class="hero-kicker mb-2">Table {{ $table_number }}</p>
                        <h1 class="hero-title display-5 mb-0">Order Summary</h1>
                    </div>
                    <a href="{{ route('menu.show', ['table_number' => $table_number]) }}"
                        class="btn btn-yk-outline rounded-4 px-4 py-3">Back to Menu</a>
                </div>

                @if (session('success'))
                    <div class="px-4 px-lg-5 pt-4">
                        <div class="alert alert-success rounded-4 mb-0">{{ session('success') }}</div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="px-4 px-lg-5 pt-4">
                        <div class="alert alert-danger rounded-4 mb-0">{{ session('error') }}</div>
                    </div>
                @endif

                @if ($cart->isEmpty())
                    <div class="p-4 p-lg-5">
                        <div class="hero-panel-soft p-4 p-lg-5">
                            <h2 class="h3 text-gold mb-3">Current Cart</h2>
                            <p class="mb-0 fs-5">No items in cart for table {{ $table_number }}.</p>
                        </div>
                    </div>
                @else
                    <div class="row g-0">
                        <div class="col-xl-8 p-4 p-lg-5">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th class="text-end">Price</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-end">Total</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $index => $item)
                                            <tr>
                                                <td class="py-4">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="rounded-4 overflow-hidden flex-shrink-0"
                                                            style="width: 92px; height: 76px; background: rgba(255,255,255,0.08);">
                                                            <img src="{{ route('menu.image', ['menu_id' => $item['menu_id']]) }}"
                                                                alt="{{ $item['menu_name'] }}"
                                                                style="width: 100%; height: 100%; object-fit: cover;">
                                                        </div>
                                                        <div>
                                                            <div class="fs-5">{{ $item['menu_name'] }}</div>
                                                            @if (!empty($item['option_name']))
                                                                <div class="text-muted-yk small mt-1">Option: {{ $item['option_name'] }}</div>
                                                            @endif
                                                            @if ($item['note'])
                                                                <div class="text-muted-yk small mt-1">{{ $item['note'] }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end py-4">฿{{ number_format($item['price'], 2) }}</td>
                                                <td class="text-center py-4">
                                                    <div class="d-inline-flex align-items-center gap-2">
                                                        <form method="POST"
                                                            action="{{ route('order.quantity', ['table_number' => $table_number]) }}"
                                                            class="mb-0">
                                                            @csrf
                                                            <input type="hidden" name="index" value="{{ $index }}">
                                                            <input type="hidden" name="action" value="decrease">
                                                            <button type="submit" class="btn btn-outline-light rounded-circle px-0"
                                                                style="width: 38px; height: 38px;">-</button>
                                                        </form>
                                                        <span
                                                            class="hero-panel-soft d-inline-flex align-items-center justify-content-center px-3 py-2"
                                                            style="min-width: 52px;">
                                                            {{ $item['quantity'] }}
                                                        </span>
                                                        <form method="POST"
                                                            action="{{ route('order.quantity', ['table_number' => $table_number]) }}"
                                                            class="mb-0">
                                                            @csrf
                                                            <input type="hidden" name="index" value="{{ $index }}">
                                                            <input type="hidden" name="action" value="increase">
                                                            <button type="submit" class="btn btn-outline-light rounded-circle px-0"
                                                                style="width: 38px; height: 38px;">+</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td class="text-end py-4 fw-semibold text-gold">
                                                    ฿{{ number_format($item['price'] * $item['quantity'], 2) }}
                                                </td>
                                                <td class="text-end py-4">
                                                    <form method="POST"
                                                        action="{{ route('order.remove', ['table_number' => $table_number]) }}">
                                                        @csrf
                                                        <input type="hidden" name="index" value="{{ $index }}">
                                                        <button type="submit" class="btn btn-danger rounded-4 px-3">Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-xl-4 p-4 p-lg-5 border-start"
                            style="border-color: rgba(242, 208, 139, 0.12) !important; background: rgba(255,255,255,0.03);">
                            <div class="hero-panel-soft p-4">
                                <h2 class="hero-title h2 mb-4">Summary</h2>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted-yk">Subtotal</span>
                                    <strong>฿{{ number_format($cartTotal, 2) }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <span class="text-muted-yk">Items</span>
                                    <strong>{{ $cart->count() }}</strong>
                                </div>
                                <div class="border-top pt-4 mb-4" style="border-color: rgba(242, 208, 139, 0.12) !important;">
                                    <div class="d-flex justify-content-between fs-3 text-gold">
                                        <span>Total</span>
                                        <strong>฿{{ number_format($cartTotal, 2) }}</strong>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('order.checkout', ['table_number' => $table_number]) }}"
                                    class="d-grid gap-3">
                                    @csrf
                                    <div>
                                        <label for="payment_method" class="form-label text-muted-yk">Payment Method</label>
                                        <select id="payment_method" name="payment_method" class="form-select rounded-4 py-3"
                                            style="background: rgba(255,255,255,0.04); border-color: rgba(242, 208, 139, 0.12);">
                                            <option value="cash">Cash</option>
                                            <option value="QR">QR</option>
                                            <option value="credit">Credit</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-yk-primary rounded-4 py-3 fs-5">
                                        Checkout ฿{{ number_format($cartTotal, 2) }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </section>
        </div>
    </main>
@endsection
