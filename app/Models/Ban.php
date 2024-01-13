<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    use HasFactory;

    protected $table = 'bans';

    protected $fillable = [
        'ten_ban',
        'slug_ban',
        'id_khu_vuc',
        'tinh_trang',
        'is_mo_ban',
    ];
}
