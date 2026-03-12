<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = 'menus';

    protected $primaryKey = 'menu_id';
    public $incrementing = false; // ถ้าไม่ใช่ auto-increment ให้ใส่ false
    protected $keyType = 'string'; // ถ้าเป็น string ให้ใส่ 'string'

    public function options()
    {
        return $this->hasMany(MenuOption::class, 'menu_id');
    }
    // ใน Menu.php
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    protected $guarded = []; // อนุญาตให้กรอกข้อมูลได้ทุกคอลัมน์ (หรือระบุรายคอลัมน์ใน $fillable)
}
