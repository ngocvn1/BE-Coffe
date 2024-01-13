<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    use HasFactory;
    protected $table = "tin_tucs";
    protected $fillable = [
        'tieu_de_tin_tuc',
        'slug_tin_tuc',
        'hinh_anh_tin_tuc',
        'mo_ta_ngan_tin_tuc',
        'mo_ta_chi_tiet_tin_tuc',
        'id_chuyen_muc_tin_tuc',
        'tinh_trang',
        'id_user',
    ];
}
