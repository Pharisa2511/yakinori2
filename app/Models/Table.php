<?php

namespace App\Models; // ตรวจสอบว่า namespace ตรงกับที่ไฟล์อยู่จริง

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    // ถ้าชื่อตารางใน Database ของคุณชื่อว่า "tables"
    // Laravel จะหาให้อัตโนมัติ ไม่ต้องตั้งค่าอะไรเพิ่ม

    // แต่ถ้าตารางใน Database ของคุณชื่ออื่น (เช่น my_tables)
    // ให้เพิ่มบรรทัดนี้:
    protected $table = 'tables';
    public $incrementing = false; // ถ้าไม่ใช่ auto-increment ให้ใส่ false
    protected $keyType = 'string'; // ถ้าเป็น string ให้ใส่ 'string'
    protected $guarded = []; // อนุญาตให้กรอกข้อมูลได้ทุกคอลัมน์ (หรือระบุรายคอลัมน์ใน $fillable)
}

