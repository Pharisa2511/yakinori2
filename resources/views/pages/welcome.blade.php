@extends('layouts.guest')

@section('content')
    <div class="hero">
        <div class="logo-container">
            <img src="{{ asset('storage/yakinori.png') }}" alt="Logo">
        </div>

        <div class="content-wrapper">
            <h1>Welcome</h1>
            <div class="btn-group">
                <a href="javascript:void(0)" class="btn" onclick="openTableModal()">ฉันเป็นลูกค้า</a>
                <a href="javascript:void(0)" class="btn" onclick="openLoginModal()">ฉันเป็นพนักงาน</a>
            </div>
        </div>
    </div>

    <div id="tableModal" class="modal">
        <div class="modal-content">
            <h2>กรุณาเลือกโต๊ะ</h2>
            <div class="table-grid">
                @foreach ($tables as $table)
                    <a href="{{ url('/menu/' . $table->table_number) }}" class="table-item">
                        โต๊ะที่ {{ $table->table_number }}
                    </a>
                @endforeach
            </div>
            <br>
            <button onclick="closeModal('tableModal')"
                style="background:none; border:none; color:gray; cursor:pointer;">ยกเลิก</button>
        </div>
    </div>

    <div id="loginModal" class="modal">
        <div class="login-card">
            <h2>Staff Login</h2>
            <form action="{{ url('/staff/login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Username :</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Password :</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn-login-submit">Login</button>
            </form>
            <br>
            <button onclick="closeModal('loginModal')"
                style="background:none; border:none; color:gray; cursor:pointer;">ยกเลิก</button>
        </div>
    </div>

    <script>
        // ฟังก์ชันเปิด Popup เลือกโต๊ะ
        function openTableModal() {
            document.getElementById("tableModal").style.display = "block";
        }

        // ฟังก์ชันเปิด Popup Login พนักงาน
        function openLoginModal() {
            document.getElementById("loginModal").style.display = "block";
        }

        // ฟังก์ชันปิด Popup (ใช้ร่วมกันได้โดยส่ง ID)
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        // ปิดเมื่อคลิกนอกพื้นที่ Popup
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = "none";
            }
        }
    </script>
@endsection
