<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $incrementing = false; // ถ้าไม่ใช่ auto-increment ให้ใส่ false
    protected $keyType = 'string'; // ถ้าเป็น string ให้ใส่ 'string'
    protected $guarded = []; // อนุญาตให้กรอกข้อมูลได้ทุกคอลัมน์ (หรือระบุรายคอลัมน์ใน $fillable)

}


