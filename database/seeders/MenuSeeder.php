<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('menus')->insert([
            ['menu_id' => 'M101', 'menu_name' => 'ซูชิรวม', 'image' => 'sushiset.png', 'status' => 'available', 'price' => 120, 'category_id' => 'C1'],
            ['menu_id' => 'M102', 'menu_name' => 'ราเม็ง', 'image' => 'ramen.png', 'status' => 'available', 'price' => 150, 'category_id' => 'C1'],
            ['menu_id' => 'M103', 'menu_name' => 'เทมปุระ', 'image' => 'tempura.png', 'status' => 'available', 'price' => 130, 'category_id' => 'C1'],
            ['menu_id' => 'M104', 'menu_name' => 'ข้าวหน้าเนื้อ', 'image' => 'gyudon.png', 'status' => 'available', 'price' => 140, 'category_id' => 'C1'],
            ['menu_id' => 'M105', 'menu_name' => 'ข้าวแกงกะหรี่', 'image' => 'curry.png', 'status' => 'available', 'price' => 120, 'category_id' => 'C1'],

            ['menu_id' => 'M201', 'menu_name' => 'ซุปกิมจิ', 'image' => 'kimchishike.png', 'status' => 'available', 'price' => 120, 'category_id' => 'C2'],
            ['menu_id' => 'M202', 'menu_name' => 'บิบิมบับ', 'image' => 'bibimbub.png', 'status' => 'available', 'price' => 140, 'category_id' => 'C2'],
            ['menu_id' => 'M203', 'menu_name' => 'โคงกุกซู', 'image' => 'konguksu.png', 'status' => 'available', 'price' => 130, 'category_id' => 'C2'],
            ['menu_id' => 'M204', 'menu_name' => 'ต๊อกบกกี', 'image' => 'tokbokkii.png', 'status' => 'available', 'price' => 110, 'category_id' => 'C2'],
            ['menu_id' => 'M205', 'menu_name' => 'ไข่ตุ๋นเกาหลี', 'image' => 'gyeranjiim.png', 'status' => 'available', 'price' => 90, 'category_id' => 'C2'],

            ['menu_id' => 'M301', 'menu_name' => 'ชุดเซตหมูปิ้งย่าง', 'image' => 'bbqset.png', 'status' => 'available', 'price' => 299, 'category_id' => 'C3'],
            ['menu_id' => 'M302', 'menu_name' => 'เนื้อรวม', 'image' => 'beef.png', 'status' => 'available', 'price' => 250, 'category_id' => 'C3'],
            ['menu_id' => 'M303', 'menu_name' => 'สามชั้น', 'image' => 'sanyopsul.png', 'status' => 'available', 'price' => 180, 'category_id' => 'C3'],
            ['menu_id' => 'M304', 'menu_name' => 'สันคอหมู', 'image' => 'moksul.png', 'status' => 'available', 'price' => 190, 'category_id' => 'C3'],
            ['menu_id' => 'M305', 'menu_name' => 'ชุดเซตหมูหมัก', 'image' => 'meatsauce.png', 'status' => 'available', 'price' => 320, 'category_id' => 'C3'],
            ['menu_id' => 'M306', 'menu_name' => 'สามชั้นหมูหมัก', 'image' => 'sanyopsul_sauce.png', 'status' => 'available', 'price' => 200, 'category_id' => 'C3'],
            ['menu_id' => 'M307', 'menu_name' => 'สันคอหมูหมัก', 'image' => 'moksul_sauce.png', 'status' => 'available', 'price' => 210, 'category_id' => 'C3'],

            ['menu_id' => 'M401', 'menu_name' => 'กิมจิผักกาดขาว', 'image' => 'kimchi.png', 'status' => 'available', 'price' => 50, 'category_id' => 'C4'],
            ['menu_id' => 'M402', 'menu_name' => 'กิมจิหัวไชเท้า', 'image' => 'kimchi_radish.png', 'status' => 'available', 'price' => 50, 'category_id' => 'C4'],
            ['menu_id' => 'M403', 'menu_name' => 'ยำถั่วงอก', 'image' => 'moyashii.png', 'status' => 'available', 'price' => 40, 'category_id' => 'C4'],
            ['menu_id' => 'M404', 'menu_name' => 'แตงกวาเผ็ด', 'image' => 'cucumber.png', 'status' => 'available', 'price' => 40, 'category_id' => 'C4'],
            ['menu_id' => 'M405', 'menu_name' => 'เต้าหู้ซอสเผ็ด', 'image' => 'tofu.png', 'status' => 'available', 'price' => 60, 'category_id' => 'C4'],

            ['menu_id' => 'M501', 'menu_name' => 'ชาเขียวญี่ปุ่น', 'image' => 'greentea.png', 'status' => 'available', 'price' => 40, 'category_id' => 'C5'],
            ['menu_id' => 'M502', 'menu_name' => 'ชาข้าว', 'image' => 'ricetea.png', 'status' => 'available', 'price' => 40, 'category_id' => 'C5'],
            ['menu_id' => 'M503', 'menu_name' => 'น้ำเปล่า', 'image' => 'water.png', 'status' => 'available', 'price' => 20, 'category_id' => 'C5'],

            ['menu_id' => 'M601', 'menu_name' => 'โดรายากิ', 'image' => 'dorayaki.png', 'status' => 'available', 'price' => 60, 'category_id' => 'C6'],
            ['menu_id' => 'M602', 'menu_name' => 'ทาโกะยากิ', 'image' => 'takoyaki.png', 'status' => 'available', 'price' => 80, 'category_id' => 'C6'],
            ['menu_id' => 'M603', 'menu_name' => 'ไอศครีมชาเขียวถั่วแดง', 'image' => 'icecream.png', 'status' => 'available', 'price' => 70, 'category_id' => 'C6']
        ]);
    }
}
