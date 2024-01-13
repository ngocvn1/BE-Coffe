<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = "san_phams";
    protected $fillable = [
        'ten_san_pham',
        'slug_san_pham',
        'gia_ban',
        'gia_khuyen_mai',
        'so_luong',
        'hinh_anh',
        'mo_ta',
        'is_open',
        'id_user',
    ];
}
