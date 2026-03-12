<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuOption extends Model
{
    protected $table = 'menu_options';
    protected $primaryKey = 'option_id'; // ระบุชื่อคอลัมน์ที่เป็น Key

    // ใส่ 2 บรรทัดนี้เพิ่มเข้าไปเพื่อให้ Laravel จัดการได้ถูกต้อง
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    // เพิ่มฟังก์ชันนี้เข้าไปครับ
    public function menu()
    {
        // บอกว่า MenuOption นี้ เป็นของ Menu อันหนึ่ง
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }
    protected $guarded = []; // อนุญาตให้กรอกข้อมูลได้ทุกคอลัมน์ (หรือระบุรายคอลัมน์ใน $fillable)
}
