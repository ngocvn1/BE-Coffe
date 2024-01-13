<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhachHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('khach_hangs')->delete();

            DB::table('khach_hangs')->truncate();

            DB::table('khach_hangs')->insert([
                [
                    'email' =>  'quoclongdng@gmail.com',
                    'ho_va_ten' => 'Quốc Long',
                    'password' => bcrypt(123456),
                ],
                [
                    'email' =>  'thanhtruong@gmail.com',
                    'ho_va_ten' => 'Thanh Trường',
                    'password' => bcrypt(123456),
                ],
                [
                    'email' =>  'huy@gmail.com',
                    'ho_va_ten' => 'huy',
                    'password' => bcrypt(123456),
                ],
            ]);
    }
}
