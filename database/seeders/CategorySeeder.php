<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['category_id'=>'C1','category_name'=>'อาหารญี่ปุ่น'],
            ['category_id'=>'C2','category_name'=>'อาหารเกาหลี'],
            ['category_id'=>'C3','category_name'=>'ปิ้งย่าง'],
            ['category_id'=>'C4','category_name'=>'เครื่องเคียง'],
            ['category_id'=>'C5','category_name'=>'เครื่องดื่ม'],
            ['category_id'=>'C6','category_name'=>'ขนมหวาน']
        ]);
    }
}
