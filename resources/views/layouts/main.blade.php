<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>Yakinori | Menu</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .content {
            margin-top: 0;
            padding-top: 1px;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar ด้านซ้าย */
        .sidebar {
            width: 150px;
            border-right: 2px solid #ddd;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
            background: #fff;
        }

        .bell-section {
            margin-top: auto;
            text-align: center;
        }

        .table-number {
            margin-top: 8px;
            font-weight: bold;
            font-size: 25px;
        }

        /* ส่วนเนื้อหาหลักด้านขวา */
        .main-wrapper {
            flex: 1;
            overflow-y: auto;
            background: #f9f9f9;
            padding-top: 1px;
            margin: 0;
            padding: 0;
        }

        /* Banner และ Navbar */
        .hero-section {
            width: 100%;
            height: 400px;
            position: relative;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background:
                linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('{{ asset('storage/herobanner.png') }}') center/cover;
        }

        .navbar {
            display: flex;
            justify-content: center;
            /* จัดให้อยู่กึ่งกลาง */
            align-items: center;
            /* จัดแนวตั้งให้อยู่กึ่งกลาง */
            gap: 30px;
            /* ปรับระยะห่างระหว่างเมนู (ลดลงถ้าเมนูยาวเกินไป) */
            flex-wrap: nowrap;
            /* สำคัญ: ห้ามปุ่มขึ้นบรรทัดใหม่ */
            padding: 15px 30px;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            width: max-content;
            /* ให้ความกว้างปรับตามเนื้อหา */
            margin: 0 auto;
            /* จัดให้อยู่ตรงกลางหน้าจอ */
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            white-space: nowrap;
            /* สำคัญ: ห้ามตัวอักษรตัดคำหรือขึ้นบรรทัดใหม่ในปุ่ม */
            display: block;
        }

        .navbar a.active {
            color: #ffcc00;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            @isset($table_number)
                <a href="{{ route('menu.show', ['table_number' => $table_number]) }}">
                    <img src="{{ asset('storage/yakinori.png') }}" style="width: 220px; cursor: pointer;">
                </a>
            @else
                <img src="{{ asset('storage/yakinori.png') }}" style="width: 100px;">
            @endisset
            <a href="{{ route('order.summary', ['table_number' => $table_number]) }}" style="text-decoration: none;">
                <a href="{{ route('order.summary', ['table_number' => $table_number]) }}">
                    <img src="{{ asset('storage/order.png') }}" style="width: 80px; margin-top: 30px; cursor: pointer;">
                </a> </a>
            <div style="margin-top: auto; text-align: center;">
                <button onclick="callStaff('{{ $table_number ?? 'ไม่ระบุ' }}')"
                    style="background: none; border: none; cursor: pointer;">
                    <img src="{{ asset('storage/bell.png') }}" style="width: 70px;">
                </button>

                @isset($table_number)
                    <p style="font-weight: bold; margin-top: 10px;">โต๊ะที่: {{ $table_number }}</p>
                @endisset
            </div>

        </div>

        <div class="main-wrapper">
            <div class="hero-section">
                <nav class="navbar">
                    @if (isset($categories) && count($categories) > 0)
                        @foreach ($categories as $category)
                            <a
                                href="{{ route('menu.category', ['table_number' => $table_number, 'category_id' => $category->category_id]) }}">
                                {{ $category->category_name }}
                            </a>
                        @endforeach
                    @else
                        <span style="color: white;">ไม่มีหมวดหมู่</span>
                    @endif
                </nav>
            </div>

            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function callStaff(tableNumber) {
            Swal.fire({
                title: 'เรียกพนักงาน',
                text: 'คุณต้องการเรียกพนักงานสำหรับโต๊ะที่ ' + tableNumber + ' ใช่หรือไม่?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, เรียกเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ตรงนี้คุณสามารถเพิ่ม AJAX ไปยัง Controller เพื่อบันทึกการเรียกใน DB ได้
                    Swal.fire(
                        'สำเร็จ!',
                        'เรียกพนักงานเรียบร้อยแล้ว กรุณารอสักครู่',
                        'success'
                    );
                }
            });
        }
    </script>
</body>

</html>
