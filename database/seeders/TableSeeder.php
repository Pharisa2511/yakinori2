<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('tables')->insert([
            ['table_id'=>'T01','table_number'=>1,'status'=>'available'],
            ['table_id'=>'T02','table_number'=>2,'status'=>'available'],
            ['table_id'=>'T03','table_number'=>3,'status'=>'available'],
            ['table_id'=>'T04','table_number'=>4,'status'=>'available'],
            ['table_id'=>'T05','table_number'=>5,'status'=>'available'],
            ['table_id'=>'T06','table_number'=>6,'status'=>'available'],
            ['table_id'=>'T07','table_number'=>7,'status'=>'available'],
            ['table_id'=>'T08','table_number'=>8,'status'=>'available'],
            ['table_id'=>'T09','table_number'=>9,'status'=>'available'],
            ['table_id'=>'T10','table_number'=>10,'status'=>'available']
        ]);
    }
}
