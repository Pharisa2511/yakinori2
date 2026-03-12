@extends('layouts.main')

@section('content')
<div class="container" style="padding: 20px;">
    <h1>รายการอาหารโต๊ะที่ {{ $table_number }}</h1>

    <table border="1" width="100%">
        <tr>
            <th>ชื่อเมนู</th>
            <th>จำนวน</th>
            <th>ราคา</th>
        </tr>
        @foreach($cart as $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ $item['price'] }}</td>
        </tr>
        @endforeach
    </table>

    <button onclick="confirmOrder()" style="margin-top: 20px;">ยืนยันการสั่งอาหาร</button>
</div>
@endsection
