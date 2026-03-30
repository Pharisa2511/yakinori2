@extends('layouts.guest')

@section('content')
<main class="guest-shell d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <style>
                    .manage-link:hover .hero-title,
                    .manage-link:hover .hero-kicker,
                    .manage-link:hover .text-muted-yk,
                    .manage-link:focus .hero-title,
                    .manage-link:focus .hero-kicker,
                    .manage-link:focus .text-muted-yk {
                        color: #1a110f !important;
                    }
                </style>
                <section class="hero-panel overflow-hidden">
                    <div class="d-flex justify-content-between align-items-center gap-3 p-4 p-lg-5 border-bottom"
                        style="border-color: rgba(242, 208, 139, 0.12) !important;">
                        <div>
                            <p class="hero-kicker mb-2">Staff Only</p>
                            <h1 class="hero-title display-5 mb-0">Manage Data</h1>
                        </div>
                        <a href="{{ route('staff.history') }}" class="btn btn-yk-outline rounded-4 px-4 py-3">Back</a>
                    </div>

                    <div class="p-4 p-lg-5">
                        <div class="row g-4">
                            <div class="col-md-6 col-xl-3">
                                <a href="{{ route('staff.manage.categories') }}" class="text-decoration-none manage-link">
                                    <div class="btn btn-yk-outline w-100 text-start rounded-4 p-4 h-100 d-block">
                                        <p class="hero-kicker mb-2">Section 1</p>
                                        <h2 class="hero-title h3 mb-2">Manage Category</h2>
                                        <p class="text-muted-yk mb-0">Add, edit, delete, and filter category data.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <a href="{{ route('staff.manage.menus') }}" class="text-decoration-none manage-link">
                                    <div class="btn btn-yk-outline w-100 text-start rounded-4 p-4 h-100 d-block">
                                        <p class="hero-kicker mb-2">Section 2</p>
                                        <h2 class="hero-title h3 mb-2">Manage Menu</h2>
                                        <p class="text-muted-yk mb-0">Manage menu list, price, image, status, and category.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <a href="{{ route('staff.manage.tables') }}" class="text-decoration-none manage-link">
                                    <div class="btn btn-yk-outline w-100 text-start rounded-4 p-4 h-100 d-block">
                                        <p class="hero-kicker mb-2">Section 3</p>
                                        <h2 class="hero-title h3 mb-2">Manage Table</h2>
                                        <p class="text-muted-yk mb-0">Manage table number and availability status.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <a href="{{ route('staff.manage.menu-options') }}" class="text-decoration-none manage-link">
                                    <div class="btn btn-yk-outline w-100 text-start rounded-4 p-4 h-100 d-block">
                                        <p class="hero-kicker mb-2">Section 4</p>
                                        <h2 class="hero-title h3 mb-2">Manage MenuOption</h2>
                                        <p class="text-muted-yk mb-0">Manage option name, extra price, and linked menu.</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
