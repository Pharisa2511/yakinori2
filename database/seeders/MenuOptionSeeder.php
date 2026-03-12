<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MenuOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu_options')->insert([
            ['option_id' => 'o10101', 'option_name' => 'S', 'extra_price' => 0, 'menu_id' => 'M101'],
            ['option_id' => 'o10102', 'option_name' => 'M', 'extra_price' => 20, 'menu_id' => 'M101'],
            ['option_id' => 'o10103', 'option_name' => 'L', 'extra_price' => 50, 'menu_id' => 'M101'],

            ['option_id' => 'o10201', 'option_name' => 'ธรรมดา', 'extra_price' => 0, 'menu_id' => 'M102'],
            ['option_id' => 'o10202', 'option_name' => 'พิเศษ', 'extra_price' => 20, 'menu_id' => 'M102'],

            ['option_id' => 'o10401', 'option_name' => 'ธรรมดา', 'extra_price' => 0, 'menu_id' => 'M104'],
            ['option_id' => 'o10402', 'option_name' => 'พิเศษ', 'extra_price' => 10, 'menu_id' => 'M104'],

            ['option_id' => 'o10501', 'option_name' => 'ธรรมดา', 'extra_price' => 0, 'menu_id' => 'M105'],
            ['option_id' => 'o10502', 'option_name' => 'พิเศษ', 'extra_price' => 10, 'menu_id' => 'M105'],

            ['option_id' => 'o20101', 'option_name' => 'หมู', 'extra_price' => 0, 'menu_id' => 'M201'],
            ['option_id' => 'o20102', 'option_name' => 'ทะเล', 'extra_price' => 0, 'menu_id' => 'M201'],

            ['option_id' => 'o20401', 'option_name' => 'โสด', 'extra_price' => 0, 'menu_id' => 'M204'],
            ['option_id' => 'o20402', 'option_name' => 'คู่รัก', 'extra_price' => 40, 'menu_id' => 'M204'],
            ['option_id' => 'o20403', 'option_name' => 'ครอบครัว', 'extra_price' => 100, 'menu_id' => 'M204'],

            ['option_id' => 'o30101', 'option_name' => 'สามชั้น', 'extra_price' => 0, 'menu_id' => 'M301'],
            ['option_id' => 'o30102', 'option_name' => 'สามชั้นหมัก', 'extra_price' => 0, 'menu_id' => 'M301'],
            ['option_id' => 'o30103', 'option_name' => 'สันคอหมู', 'extra_price' => 0, 'menu_id' => 'M301'],
            ['option_id' => 'o30104', 'option_name' => 'สันคอหมูหมัก', 'extra_price' => 0, 'menu_id' => 'M301'],

            ['option_id' => 'o30201', 'option_name' => 'เนื้อสันคอ', 'extra_price' => 0, 'menu_id' => 'M302'],
            ['option_id' => 'o30202', 'option_name' => 'เนื้อซี่โครง', 'extra_price' => 0, 'menu_id' => 'M302'],
            ['option_id' => 'o30203', 'option_name' => 'เสือร้องไห้', 'extra_price' => 0, 'menu_id' => 'M302'],

            ['option_id' => 'o50101', 'option_name' => 'ร้อน', 'extra_price' => 0, 'menu_id' => 'M501'],
            ['option_id' => 'o50102', 'option_name' => 'เย็น', 'extra_price' => 10, 'menu_id' => 'M501'],

            ['option_id' => 'o50201', 'option_name' => 'ร้อน', 'extra_price' => 0, 'menu_id' => 'M502'],
            ['option_id' => 'o50202', 'option_name' => 'เย็น', 'extra_price' => 10, 'menu_id' => 'M502']

        ]);
    }
}
