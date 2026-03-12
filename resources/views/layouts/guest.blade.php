<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>Yakinori | Welcome</title>
    <style>
        /* 1. ลบขอบหน้าจอทั้งหมด */
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Kanit', sans-serif;
            /* แนะนำใช้ฟอนต์ Kanit จะสวยมาก */
            overflow: hidden;
        }

        /* 2. พื้นหลังเต็มจอพร้อมเลเยอร์สีดำโปร่งแสง */
        .hero {
            width: 100vw;
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('{{ asset('storage/herobanner.png') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            /* สำคัญ: เพื่อให้ Logo อ้างอิงตำแหน่งจากตัวนี้ */
        }

        /* 3. จัดตำแหน่ง Logo ไปไว้มุมซ้ายบน */
        .logo-container {
            position: absolute;
            top: 30px;
            /* ห่างจากขอบบน */
            left: 30px;
            /* ห่างจากขอบซ้าย */
        }

        .logo-container img {
            width: 250px;
            /* ปรับขนาด Logo ตามความเหมาะสม */
            height: auto;
        }

        /* 4. กล่องเนื้อหาตรงกลาง (ยกให้สูงขึ้น) */
        .content-wrapper {
            text-align: center;
            margin-top: -200px;
            /* เลขติดลบคือการ "ยกขึ้น" ยิ่งลบเยอะยิ่งสูง */
        }

        h1 {
            font-size: 60px;
            color: white;
            margin-bottom: 40px;
            letter-spacing: 2px;
        }

        /* 5. กลุ่มปุ่ม */
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 25px;
            /* ระยะห่างระหว่างปุ่ม */
            width: 300px;
        }

        .btn {
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            /* ดำใสๆ */
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            text-decoration: none;
            font-size: 22px;
            transition: all 0.3s ease;
            /* ทำให้เวลาชี้แล้วนุ่มนวล */
            backdrop-filter: blur(5px);
            /* เพิ่มความหรูหราด้วยการเบลอหลังปุ่ม */
        }

        .btn:hover {
            background: white;
            color: black;
            transform: translateY(-5px);
            /* เวลาชี้แล้วปุ่มเด้งขึ้นเล็กน้อย */
        }

        /* สไตล์ของ Popup (Modal) */
        .modal {
            display: none;
            /* ปิดไว้ก่อน */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            /* พื้นหลังดำโปร่งแสง */
            backdrop-filter: blur(8px);
        }

        .modal-content {
            background-color: #1a1a1a;
            margin: 10% auto;
            padding: 30px;
            border: 1px solid #444;
            width: 80%;
            max-width: 500px;
            text-align: center;
            color: white;
            border-radius: 15px;
        }

        /* การจัดวางเลขโต๊ะข้างใน Popup */
        .table-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* แบ่งเป็น 3 คอลัมน์ */
            gap: 15px;
            margin-top: 20px;
        }

        .table-item {
            padding: 15px;
            background: #333;
            border: 1px solid #555;
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            transition: 0.3s;
        }

        .table-item:hover {
            background: white;
            color: black;
        }

        /* เพิ่มเติมสไตล์สำหรับ Staff Login Popup */
        .login-card {
            background-color: white;
            /* พื้นหลังสีขาวตามดีไซน์ */
            margin: 8% auto;
            padding: 40px;
            width: 90%;
            max-width: 500px;
            border-radius: 20px;
            /* ขอบมน */
            color: #333;
            /* ตัวอักษรสีเข้ม */
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .login-card h2 {
            margin-bottom: 30px;
            color: #000;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-group label {
            width: 120px;
            text-align: left;
            font-weight: bold;
        }

        .form-group input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-login-submit {
            background-color: #d32f2f;
            /* สีแดงตามปุ่มในรูป */
            color: white;
            border: none;
            padding: 12px 40px;
            border-radius: 25px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn-login-submit:hover {
            background-color: #b71c1c;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    @yield('content') {{-- จุดที่เนื้อหาจากหน้าลูกจะมาแปะ --}}
</body>

</html>
