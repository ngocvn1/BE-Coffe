<?php

use App\Http\Controllers\BanController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\KhuVucController;
use App\Http\Controllers\NguyenLieuController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\NhapKhoController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TestController::class, 'index']);
Route::get('/admin/nhan-vien', [NhanVienController::class, 'index']);
Route::get('/admin/chuc-vu', [ChucVuController::class, 'index']);
Route::get('/admin/danh-muc', [DanhMucController::class, 'index']);
Route::get('/admin/ban', [BanController::class, 'index']);
Route::get('/admin/khu-vuc', [KhuVucController::class, 'index']);
Route::get('/admin/nguyen-lieu', [NguyenLieuController::class, 'index']);
Route::get('/admin/nhap-kho', [NhapKhoController::class, 'index']);
