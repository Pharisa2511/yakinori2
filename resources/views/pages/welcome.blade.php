@extends('layouts.guest')

@section('content')
    <main class="guest-shell d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 col-xl-6">
                    <section class="hero-panel text-center p-4 p-md-5">
                        <p class="hero-kicker mb-3">Japanese x Korean Dining</p>
                        <h1 class="display-3 fw-semibold text-white mb-4">Welcome</h1>
                        <p class="text-muted-yk fs-5 mb-5">เลือกรูปแบบการเข้าใช้งานเพื่อเริ่มต้นสั่งอาหารหรือดูประวัติออเดอร์</p>

                        <div class="d-grid gap-3 col-md-8 mx-auto">
                            <button type="button" class="btn btn-lg btn-yk-outline rounded-4 py-3" data-bs-toggle="modal"
                                data-bs-target="#tableModal">
                                ฉันเป็นลูกค้า
                            </button>
                            <button type="button" class="btn btn-lg btn-yk-primary rounded-4 py-3" data-bs-toggle="modal"
                                data-bs-target="#loginModal">
                                Staff Login
                            </button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="tableModal" tabindex="-1" aria-labelledby="tableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content hero-panel border-0">
                <div class="modal-header border-bottom" style="border-color: rgba(242, 208, 139, 0.12) !important;">
                    <h2 class="modal-title fs-3 hero-title" id="tableModalLabel">เลือกโต๊ะ</h2>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        @foreach ($tables as $table)
                            <div class="col-6 col-md-4">
                                <a href="{{ url('/menu/' . $table->table_number) }}"
                                    class="btn btn-yk-outline w-100 rounded-4 py-3">
                                    โต๊ะที่ {{ $table->table_number }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content hero-panel border-0">
                <div class="modal-header border-bottom" style="border-color: rgba(242, 208, 139, 0.12) !important;">
                    <h2 class="modal-title fs-3 hero-title" id="loginModalLabel">Staff Login</h2>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 p-md-5">
                    @if (session('staff_error'))
                        <div class="alert alert-danger rounded-4 mb-4">
                            {{ session('staff_error') }}
                        </div>
                    @endif

                    <form action="{{ route('staff.login') }}" method="POST" class="d-grid gap-3">
                        @csrf
                        <div>
                            <label for="username" class="form-label text-muted-yk">Username</label>
                            <input id="username" type="text" name="username" class="form-control rounded-4 py-3" required>
                        </div>
                        <div>
                            <label for="password" class="form-label text-muted-yk">Password</label>
                            <input id="password" type="password" name="password" class="form-control rounded-4 py-3" required>
                        </div>
                        <button type="submit" class="btn btn-yk-primary rounded-4 py-3 mt-2">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        @if (session('staff_error'))
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        @endif
    </script>
@endpush
