@extends('layouts.guest')

@section('content')
    <main class="guest-shell d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">
                    <section class="hero-panel overflow-hidden">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-start gap-3 p-4 p-lg-5 border-bottom"
                            style="border-color: rgba(242, 208, 139, 0.12) !important;">
                            <div>
                                <p class="hero-kicker mb-2">Staff Only</p>
                                <h1 class="hero-title display-5 mb-3">Staff History</h1>
                                <p class="text-muted-yk mb-0 fs-5">เลือกโต๊ะเพื่อดูประวัติการชำระเงินและใบเสร็จย้อนหลัง</p>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="{{ route('staff.manage') }}" class="btn btn-yk-primary rounded-4 px-4 py-3 me-2">
                                    Manage Data
                                </a>
                                <a href="{{ url('/') }}" class="btn btn-yk-outline rounded-4 px-4 py-3">
                                    กลับหน้าหลัก
                                </a>
                            </div>
                        </div>

                        <div class="p-4 p-lg-5">
                            <div class="row g-3">
                                @foreach ($tables as $table)
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <a href="{{ route('order.history', ['table_number' => $table->table_number]) }}"
                                            class="btn btn-yk-outline w-100 rounded-4 py-3">
                                            โต๊ะที่ {{ $table->table_number }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
@endsection
