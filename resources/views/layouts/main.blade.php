<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yakinori | Menu</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --yk-gold: #f2d08b;
            --yk-orange: #de6f2d;
            --yk-ink: #17100f;
            --yk-soft: #f8f3ec;
            --yk-muted: #715f58;
            --yk-border: rgba(122, 78, 53, 0.16);
            --yk-sidebar: #fffaf4;
            --yk-panel: rgba(18, 10, 10, 0.74);
        }

        body {
            font-family: 'Kanit', sans-serif;
            background: #f7f1ea;
            color: #231918;
        }

        [x-cloak] {
            display: none !important;
        }

        .app-shell {
            min-height: 100vh;
            background:
                linear-gradient(rgba(247, 241, 234, 0.92), rgba(247, 241, 234, 0.92)),
                url('{{ asset('storage/herobanner.png') }}') center/cover fixed;
        }

        .sidebar-panel {
            width: 250px;
            height: 100vh;
            position: sticky;
            top: 0;
            background: var(--yk-sidebar);
            border-right: 1px solid rgba(122, 78, 53, 0.12);
        }

        .brand-logo {
            width: 220px;
            max-width: 100%;
            height: auto;
        }

        .icon-button img {
            width: 78px;
            height: auto;
            transition: transform 0.2s ease;
        }

        .icon-button:hover img {
            transform: translateY(-2px);
        }

        .cart-badge {
            min-width: 30px;
            height: 30px;
            border-radius: 999px;
            background: #ad2f2f;
            color: #fff;
            font-weight: 700;
        }

        .hero-banner {
            min-height: 360px;
            background:
                linear-gradient(rgba(0, 0, 0, 0.48), rgba(0, 0, 0, 0.48)),
                url('{{ asset('storage/herobanner.png') }}') center/cover;
        }

        .category-nav {
            transform: translateY(-28px);
            position: sticky;
            top: 18px;
            z-index: 1020;
        }

        .category-strip {
            width: fit-content;
            max-width: calc(100% - 32px);
            background: rgba(16, 10, 10, 0.74);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .category-link {
            color: rgba(255, 244, 226, 0.82);
            text-decoration: none;
            font-weight: 500;
            font-size: 1.15rem;
            border-radius: 999px;
            padding: 0.7rem 1.1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        .category-link:hover,
        .category-link.active {
            background: rgba(242, 208, 139, 0.16);
            color: #fff4d8;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1b1110;
        }

        .section-lines {
            width: min(240px, 32vw);
        }

        .section-lines span {
            height: 3px;
            background: var(--yk-orange);
            border-radius: 999px;
            flex: 1;
        }

        .menu-modal .modal-content {
            background: linear-gradient(135deg, rgba(20, 12, 12, 0.97), rgba(39, 20, 17, 0.96));
            color: #fff4df;
            border: 1px solid rgba(242, 208, 139, 0.14);
            border-radius: 1.5rem;
        }

        .menu-modal .form-control,
        .menu-modal .form-check-input {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: rgba(242, 208, 139, 0.22);
        }

        .menu-modal .form-control {
            color: #fff4df;
        }

        .menu-modal .form-control::placeholder {
            color: rgba(242, 208, 139, 0.66);
        }

        .menu-modal .form-control:focus {
            background-color: rgba(255, 255, 255, 0.12);
            color: #fff4df;
            border-color: rgba(242, 208, 139, 0.38);
            box-shadow: 0 0 0 0.2rem rgba(242, 208, 139, 0.14);
        }

        @media (max-width: 991.98px) {
            .sidebar-panel {
                width: 100%;
                height: auto;
                position: static;
                border-right: none;
                border-bottom: 1px solid rgba(122, 78, 53, 0.12);
            }

            .hero-banner {
                min-height: 260px;
            }

            .category-nav {
                transform: translateY(-18px);
                top: 12px;
            }

            .section-title {
                font-size: 1.7rem;
            }

            .category-link {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    @php($cartCount = isset($table_number) ? count(session('cart.table.' . $table_number, [])) : 0)

    <div class="app-shell d-lg-flex">
        <aside class="sidebar-panel d-flex flex-lg-column align-items-center justify-content-between gap-4 p-3 p-lg-4">
            <div class="w-100 text-center">
                @isset($table_number)
                    <a href="{{ route('menu.show', ['table_number' => $table_number]) }}">
                        <img src="{{ asset('storage/yakinori.png') }}" alt="Yakinori" class="brand-logo">
                    </a>
                @else
                    <img src="{{ asset('storage/yakinori.png') }}" alt="Yakinori" class="brand-logo">
                @endisset
            </div>

            <div class="d-flex flex-row flex-lg-column align-items-center gap-3 gap-lg-4">
                <a href="{{ route('order.summary', ['table_number' => $table_number]) }}"
                    class="icon-button text-decoration-none text-center">
                    <img src="{{ asset('storage/order.png') }}" alt="Order">
                </a>
                @if ($cartCount > 0)
                    <div class="cart-badge d-flex align-items-center justify-content-center">
                        {{ $cartCount }}
                    </div>
                @endif
            </div>

            <div class="text-center mt-lg-auto">
                <button type="button" class="btn border-0 p-0 icon-button"
                    onclick="callStaff('{{ $table_number ?? 'ไม่ระบุ' }}')">
                    <img src="{{ asset('storage/bell.png') }}" alt="Call Staff">
                </button>

                @isset($table_number)
                    <p class="mt-3 mb-0 fw-semibold fs-4">โต๊ะที่: {{ $table_number }}</p>
                @endisset
            </div>
        </aside>

        <main class="flex-grow-1">
            <section class="hero-banner d-flex align-items-start justify-content-center px-3 px-lg-4 pt-4 pt-lg-5">
                <nav class="category-nav w-100 d-flex justify-content-center">
                    <div class="category-strip rounded-pill px-3 py-2 overflow-auto">
                        <div class="d-flex align-items-center gap-2 flex-nowrap">
                            @if (isset($categories) && count($categories) > 0)
                                @foreach ($categories as $category)
                                    @php($isActive = request()->routeIs('menu.category') && request()->route('category_id') === $category->category_id)
                                    <a href="{{ route('menu.category', ['table_number' => $table_number, 'category_id' => $category->category_id]) }}"
                                        class="category-link {{ $isActive ? 'active' : '' }}">
                                        {{ $category->category_name }}
                                    </a>
                                @endforeach
                            @else
                                <span class="text-white-50 px-3">ไม่มีหมวดหมู่</span>
                            @endif
                        </div>
                    </div>
                </nav>
            </section>

            <div class="container-fluid px-3 px-lg-4 pb-5">
                @yield('content')
            </div>
        </main>
    </div>

    <div class="modal fade menu-modal" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form method="POST" action="{{ route('order.add', ['table_number' => $table_number]) }}" class="modal-content">
                @csrf
                <div class="modal-header border-0 px-4 px-lg-5 pt-4 pt-lg-5">
                    <h2 class="modal-title fs-2" id="menuModalLabel">เพิ่มรายการอาหาร</h2>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 px-lg-5 pb-4">
                    <input type="hidden" name="menu_id" id="menuIdInput">
                    <input type="hidden" name="menu_name" id="menuNameInput">
                    <input type="hidden" name="total_price" id="totalPriceInput">
                    <input type="hidden" name="option_name" id="optionNameInput">
                    <input type="hidden" name="option_extra_price" id="optionExtraPriceInput" value="0">
                    <input type="hidden" name="table_number" value="{{ $table_number }}">
                    <input type="hidden" name="table_id" value="{{ $table_number }}">

                    <div class="row g-4 align-items-start">
                        <div class="col-md-4">
                            <div class="rounded-4 overflow-hidden" style="background: rgba(255,255,255,0.08);">
                                <img id="modalImg" src="" alt="" class="w-100" style="height: 220px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h3 id="modalName" class="mb-3"></h3>
                            <p class="text-white-50 mb-3">Option</p>
                            <div id="optionsContainer" class="d-grid gap-2"></div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="modalNote" class="form-label" style="color: #f2d08b;">หมายเหตุเพิ่มเติม</label>
                        <textarea name="note" id="modalNote" class="form-control rounded-4 p-3"
                            placeholder="Leave any special instructions here..." rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 px-lg-5 pb-4 pb-lg-5 d-flex justify-content-between">
                    <h3 id="totalPrice" class="mb-0">Total: ฿0</h3>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-light rounded-4 px-4" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn rounded-4 px-4 text-white"
                            style="background: linear-gradient(135deg, #7e0f0f, #cd3327);">
                            Add to Order
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let basePrice = 0;
        let menuModalInstance = null;

        document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('menuModal');
            menuModalInstance = new bootstrap.Modal(modalElement);

            const orderForm = modalElement.querySelector('form');

            orderForm.addEventListener('submit', async function(event) {
                event.preventDefault();

                const formData = new FormData(orderForm);

                try {
                    const response = await fetch(orderForm.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(data.message || 'Unable to add this order.');
                    }

                    menuModalInstance.hide();

                    Swal.fire({
                        title: 'Success',
                        text: data.message,
                        icon: 'success',
                    }).then(() => window.location.reload());
                } catch (error) {
                    Swal.fire({
                        title: 'Error',
                        text: error.message,
                        icon: 'error',
                    });
                }
            });
        });

        function openMenuModal(menuId, name, price, imageUrl, optionsJson) {
            basePrice = parseFloat(price);

            document.getElementById('menuIdInput').value = menuId;
            document.getElementById('modalName').innerText = name;
            document.getElementById('modalImg').src = imageUrl;
            document.getElementById('menuNameInput').value = name;
            document.getElementById('totalPriceInput').value = basePrice;
            document.getElementById('optionNameInput').value = '';
            document.getElementById('optionExtraPriceInput').value = 0;
            document.getElementById('totalPrice').innerText = 'Total: ฿' + basePrice.toFixed(2);
            document.getElementById('modalNote').value = '';

            const container = document.getElementById('optionsContainer');
            container.innerHTML = '';

            if (optionsJson) {
                const options = JSON.parse(optionsJson);

                options.forEach((opt, index) => {
                    const extra = parseFloat(opt.extra_price);
                    const optionId = `option-${index}`;

                    container.innerHTML += `
                        <label for="${optionId}" class="d-flex align-items-center gap-2 rounded-4 px-3 py-2"
                            style="background: rgba(255,255,255,0.05); cursor: pointer;">
                            <input class="form-check-input mt-0" type="radio" id="${optionId}" name="opt"
                                onchange='updatePrice(${extra}, ${JSON.stringify(opt.option_name)})'>
                            <span>${opt.option_name} (+฿${extra.toFixed(2)})</span>
                        </label>
                    `;
                });
            }

            menuModalInstance.show();
        }

        function updatePrice(extra, optionName = '') {
            const total = basePrice + parseFloat(extra);
            document.getElementById('totalPrice').innerText = 'Total: ฿' + total.toFixed(2);
            document.getElementById('totalPriceInput').value = total;
            document.getElementById('optionNameInput').value = optionName;
            document.getElementById('optionExtraPriceInput').value = parseFloat(extra).toFixed(2);
        }

        function callStaff(tableNumber) {
            Swal.fire({
                title: 'เรียกพนักงาน',
                text: 'ต้องการเรียกพนักงานสำหรับโต๊ะที่ ' + tableNumber + ' ใช่หรือไม่?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, เรียกเลย',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'สำเร็จ',
                        'เรียกพนักงานเรียบร้อยแล้ว กรุณารอสักครู่',
                        'success'
                    );
                }
            });
        }
    </script>
</body>

</html>
