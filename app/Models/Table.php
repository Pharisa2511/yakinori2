<?php

namespace App\Models; // ตรวจสอบว่า namespace ตรงกับที่ไฟล์อยู่จริง

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    // ถ้าชื่อตารางใน Database ของคุณชื่อว่า "tables"
    // Laravel จะหาให้อัตโนมัติ ไม่ต้องตั้งค่าอะไรเพิ่ม

    // แต่ถ้าตารางใน Database ของคุณชื่ออื่น (เช่น my_tables)
    // ให้เพิ่มบรรทัดนี้:
    // protected $table = 'my_tables';
}
