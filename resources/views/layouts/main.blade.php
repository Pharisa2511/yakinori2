<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>Yakinori | Menu</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

        /* เพิ่มในส่วนของ style */
        [x-cloak] {
            display: none !important;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            /* พื้นหลังดำโปร่ง */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 99999;
            /* ให้ลอยอยู่บนสุดเสมอ */
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            width: 400px;
            text-align: center;
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
            position: sticky;
            /* ทำให้เลื่อนตามหน้าจอ */
            top: 0;
            /* ล็อคไว้ที่ขอบบน */
            height: 100vh;
            /* สูงเต็มหน้าจอ */
            width: 250px;
            /* ปรับความกว้างตามที่ต้องการ */
            display: flex;
            /* ใช้ flexbox จัดแนวตั้ง */
            flex-direction: column;
            /* เรียงจากบนลงล่าง */
            align-items: center;
            /* จัดให้อยู่กึ่งกลางแนวนอน */
            padding: 20px 10px;
            background-color: #fff;
            /* หรือสีพื้นหลังของร้าน */
            border-right: 1px solid #ddd;
            /* เส้นขอบข้าง */
            flex-shrink: 0;
            /* ห้าม Sidebar หดตัว */
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
            position: sticky;
            /* หรือ fixed หากต้องการให้ลอยค้างหน้าจอไม่ว่าเลื่อนไปไหน */
            top: 20px;
            /* เว้นระยะจากขอบบน 20px */
            z-index: 9999;
            /* ให้ลอยอยู่เหนือทุกสิ่ง */

            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            flex-wrap: nowrap;
            padding: 15px 30px;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 50px;

            /* ปรับปรุงการจัดวาง */
            width: fit-content;
            margin: 0 auto;
            left: 0;
            right: 0;
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

            <a href="{{ route('order.summary', ['table_number' => $table_number]) }}" style="margin-top: 30px;">
                <img src="{{ asset('storage/order.png') }}" style="width: 80px; cursor: pointer;">
            </a>

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
    <div id="menuModal" class="modal-overlay" style="display: none; background: rgba(0,0,0,0.85);">
        <div class="modal-content"
            style="background: #1a1a1a; color: #e0d0a0; padding: 25px; border-radius: 15px; width: 450px; border: 1px solid #444;">

            <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                <img id="modalImg" src=""
                    style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px;">
                <div>
                    <h2 id="modalName" style="margin: 0;"></h2>
                    <p style="margin: 5px 0 0; opacity: 0.8;">Option</p>
                    <div id="optionsContainer" style="margin-top: 10px;"></div>
                </div>
            </div>

            <textarea id="modalNote" placeholder="Leave any special instructions here..."
                style="width: 100%; height: 80px; background: #333; color: white; border: none; padding: 10px; border-radius: 5px;"></textarea>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
                <h3 id="totalPrice">Total: ฿0</h3>
                <div>
                    <button onclick="closeMenuModal()"
                        style="background: transparent; color: #aaa; border: 1px solid #555; padding: 8px 15px; border-radius: 5px;">Cancel</button>
                    <button onclick="addToOrder()"
                        style="background: #a02020; color: white; border: none; padding: 8px 20px; border-radius: 5px;">Add
                        to Order</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let basePrice = 0;

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

        function openMenuModal(name, price, image, optionsJson) {
            basePrice = parseFloat(price);

            // ตั้งค่ารูปและชื่อ
            document.getElementById('modalName').innerText = name;
            document.getElementById('modalImg').src = '/storage/' + image;
            document.getElementById('totalPrice').innerText = 'Total: ฿' + basePrice;

            let container = document.getElementById('optionsContainer');
            container.innerHTML = '';

            // ตรวจสอบว่า optionsJson มีค่าหรือไม่
            if (optionsJson && optionsJson !== '[]') {
                try {
                    const options = JSON.parse(optionsJson);
                    options.forEach(opt => {
                        let extra = parseFloat(opt.extra_price);
                        container.innerHTML += `
                <label style="display: block; cursor: pointer; margin-bottom: 5px;">
                    <input type="radio" name="opt" value="${extra}"
                           onchange="updatePrice(${extra})">
                    ${opt.option_name} (+฿${extra})
                </label>`;
                    });
                } catch (e) {
                    console.error("Error parsing options:", e);
                }
            } else {
                container.innerHTML = '<p>ไม่มีตัวเลือกเพิ่มเติม</p>';
            }

            document.getElementById('menuModal').style.display = 'flex';
        }

        function updatePrice(extra) {
            document.getElementById('totalPrice').innerText = 'Total: ฿' + (basePrice + parseFloat(extra));
        }

        function closeMenuModal() {
            document.getElementById('menuModal').style.display = 'none';
        }
    </script>

</body>

</html>
