<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class KhachHang extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'khach_hangs';

    protected $fillable = [
        'email',
        'ho_va_ten',
        'password',
    ];
}
