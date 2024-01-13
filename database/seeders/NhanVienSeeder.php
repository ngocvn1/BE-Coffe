<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nhan_viens')->delete();

        DB::table('nhan_viens')->truncate();

        DB::table('nhan_viens')->insert([
            ['id' => '1', 'ho_va_ten' => 'Admin', 'email' => 'admin@master.com', 'password' => bcrypt('123456'), 'so_dien_thoai' => '123456789', 'dia_chi' => 'Đà Nẵng', 'id_chuc_vu' => '0', 'tinh_trang' => '1'],
            ['id' => '2', 'ho_va_ten' => 'Lê Thanh Trường', 'email' => 'thanhtruong@gmail.com', 'password' => bcrypt('123456'), 'so_dien_thoai' => '123456790', 'dia_chi' => 'Đà Nẵng', 'id_chuc_vu' => '0', 'tinh_trang' => '1'],
            ['id' => '3', 'ho_va_ten' => 'Võ Đình Quốc Huy', 'email' => 'quochuy@gmail.com', 'password' => bcrypt('123456'), 'so_dien_thoai' => '123456791', 'dia_chi' => 'Đà Nẵng', 'id_chuc_vu' => '0', 'tinh_trang' => '1'],
            ['id' => '4', 'ho_va_ten' => 'Nguyễn Vũ Huy', 'email' => 'vuhuy@gmail.com', 'password' => bcrypt('123456'), 'so_dien_thoai' => '123456792', 'dia_chi' => 'Đà Nẵng', 'id_chuc_vu' => '0', 'tinh_trang' => '1'],
            ['id' => '5', 'ho_va_ten' => 'Trương Công Thạch', 'email' => 'congthach@gmail.com', 'password' => bcrypt('123456'), 'so_dien_thoai' => '123456793', 'dia_chi' => 'Đà Nẵng', 'id_chuc_vu' => '0', 'tinh_trang' => '0'],
            ['id' => '6', 'ho_va_ten' => 'Phan Minh Tiến', 'email' => 'minhtien@gmail.com', 'password' => bcrypt('123456'), 'so_dien_thoai' => '123456794', 'dia_chi' => 'Đà Nẵng', 'id_chuc_vu' => '0', 'tinh_trang' => '1'],
            ['id' => '7', 'ho_va_ten' => 'Mai Thị Thanh Trúc', 'email' => 'thanhtruc@gmail.com', 'password' => bcrypt('123456'), 'so_dien_thoai' => '123456795', 'dia_chi' => 'Đà Nẵng', 'id_chuc_vu' => '0', 'tinh_trang' => '1'],
            ['id' => '8', 'ho_va_ten' => 'Tiến Đẹp Trai', 'email' => 'tiendeptrai@gmail.com', 'password' => bcrypt('123456'), 'so_dien_thoai' => '123456796', 'dia_chi' => 'Đà Nẵng', 'id_chuc_vu' => '0', 'tinh_trang' => '0'],
            ['id' => '9', 'ho_va_ten' => 'Đức Ròm', 'email' => 'ducrom@gmail.com', 'password' => bcrypt('123456'), 'so_dien_thoai' => '123456797', 'dia_chi' => 'Đà Nẵng', 'id_chuc_vu' => '0', 'tinh_trang' => '1'],
        ]);
    }
}
