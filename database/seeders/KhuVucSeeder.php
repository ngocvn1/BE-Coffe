<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KhuVucSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('khu_vucs')->delete();

        DB::table('khu_vucs')->insert([
            [
                'id'            =>  1,
                'ten_khu'       =>  'Khu A',
                'slug_khu'      =>  Str::slug('Khu A'),
                'tinh_trang'    =>  random_int(0, 1),
            ],
            [
                'id'            =>  2,
                'ten_khu'       =>  'Khu B',
                'slug_khu'      =>  Str::slug('Khu B'),
                'tinh_trang'    =>  random_int(0, 1),
            ],
            [
                'id'            =>  3,
                'ten_khu'       =>  'Khu C',
                'slug_khu'      =>  Str::slug('Khu C'),
                'tinh_trang'    =>  random_int(0, 1),
            ],
        ]);
    }
}
