<?php

use App\Http\Controllers\BanController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\ChuyenMucTinTucController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\HoaDonKhachHangController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\KhuVucController;
use App\Http\Controllers\MonAnController;
use App\Http\Controllers\NguyenLieuController;
use App\Http\Controllers\NhaCungCapController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\NhapKhoController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\TrangChuController;
use App\Models\HoaDonKhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [KhachHangController::class, 'login']);
Route::post('/register', [KhachHangController::class, 'register']);
Route::post('/check', [KhachHangController::class, 'check']);
Route::delete('/remove-token/{id}', [KhachHangController::class, 'removeToken']);

Route::get('lay-du-lieu-san-pham',[TrangChuController::class,'viewSanPham']);
Route::get('lay-du-lieu-bai-viet',[TrangChuController::class,'viewBaiViet']);

// Chia các nhóm ra như sau
// Nhân Viên
Route::group(['prefix'  =>  '/admin'], function () {
    // Những gì của danh mục thì ta sẽ nhét ở group này
    Route::group(['prefix'  =>  '/danh-muc'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [DanhMucController::class, 'getData']);
        Route::post('/tim-danh-muc', [DanhMucController::class, 'searchDanhMuc']);
        Route::post('/tao-danh-muc', [DanhMucController::class, 'createDanhMuc']);
        Route::delete('/xoa-danh-muc/{id}', [DanhMucController::class, 'xoaDanhMuc']);
        Route::put('/cap-nhat-danh-muc', [DanhMucController::class, 'capNhatDanhMuc']);
        Route::put('/doi-trang-thai', [DanhMucController::class, 'doiTrangThaiDanhMuc']);

        Route::post('/kiem-tra-slug', [DanhMucController::class, 'kiemTraSlugDanhMuc']);
    });
    Route::group(['prefix'  =>  '/san-pham'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [SanPhamController::class, 'getData']);
        Route::post('/tao-san-pham', [SanPhamController::class, 'createSanPham']);
        Route::delete('/xoa-san-pham/{id}', [SanPhamController::class, 'xoaSanPham']);
        Route::put('/cap-nhat-san-pham', [SanPhamController::class, 'capNhatSanPham']);
        Route::put('/doi-trang-thai', [SanPhamController::class, 'doiTrangThaiSanPham']);
    });

    // Những gì của nhân viên thì ta sẽ nhét ở group này
    Route::group(['prefix'  =>  '/nhan-vien'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [NhanVienController::class, 'getData']);
        Route::post('/tim-nhan-vien', [NhanVienController::class, 'searchNhanVien']);
        Route::post('/tao-nhan-vien', [NhanVienController::class, 'createNhanVien']);
        Route::delete('/xoa-nhan-vien/{id}', [NhanVienController::class, 'xoaNhanVien']);
        Route::put('/cap-nhat-nhan-vien', [NhanVienController::class, 'capNhatNhanVien']);
        Route::put('/doi-trang-thai', [NhanVienController::class, 'doiTrangThaiNhanVien']);
    });

    // Những gì của chức vụ thì ta sẽ nhét ở group này
    Route::group(['prefix'  =>  '/chuc-vu'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [ChucVuController::class, 'getData']);
        Route::post('/tim-chuc-vu', [ChucVuController::class, 'searchChucVu']);
        Route::post('/tao-chuc-vu', [ChucVuController::class, 'createChucVu']);
        Route::delete('/xoa-chuc-vu/{id}', [ChucVuController::class, 'xoaChucVu']);
        Route::put('/cap-nhat-chuc-vu', [DanhMucController::class, 'capNhatChucVu']);
        Route::put('/doi-trang-thai', [DanhMucController::class, 'doiTrangThaiChucVu']);
    });

    // Những gì của chức vụ thì ta sẽ nhét ở group này
    Route::group(['prefix'  =>  '/ban'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [BanController::class, 'getData']);
        Route::post('/tim-ban', [BanController::class, 'searchBan']);
        Route::post('/tao-ban', [BanController::class, 'createBan']);
        Route::delete('/xoa-ban/{id}', [BanController::class, 'xoaBan']);
        Route::put('/cap-nhat-ban', [BanController::class, 'capNhatBan']);
        Route::put('/doi-trang-thai', [BanController::class, 'doiTrangThaiBan']);

        Route::post('/kiem-tra-slug', [BanController::class, 'kiemTraSlugBan']);
        Route::post('/kiem-tra-slug-update', [BanController::class, 'kiemTraSlugBanUpdate']);
    });

    // Những gì của chức vụ thì ta sẽ nhét ở group này
    Route::group(['prefix'  =>  '/khu-vuc'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [KhuVucController::class, 'getData']);
        Route::get('/lay-du-lieu-hoat-dong', [KhuVucController::class, 'getDataHoatDong']);
        Route::post('/tim-khu-vuc', [KhuVucController::class, 'searchKhuVuc']);
        Route::post('/tao-khu-vuc', [KhuVucController::class, 'createKhuVuc']);
        Route::delete('/xoa-khu-vuc/{id}', [KhuVucController::class, 'xoaKhuVuc']);
        Route::put('/cap-nhat-khu-vuc', [KhuVucController::class, 'capNhatKhuVuc']);
        Route::put('/doi-trang-thai', [KhuVucController::class, 'doiTrangThaiKhuVuc']);

        Route::post('/kiem-tra-slug', [KhuVucController::class, 'kiemTraSlugKhuVuc']);
        Route::post('/kiem-tra-slug-update', [KhuVucController::class, 'kiemTraSlugKhuVucUpdate']);
    });

    // Những gì của chức vụ thì ta sẽ nhét ở group này
    Route::group(['prefix'  =>  '/nguyen-lieu'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [NguyenLieuController::class, 'getData']);
        Route::post('/tim-nguyen-lieu', [NguyenLieuController::class, 'searchNguyenLieu']);
        Route::post('/tao-nguyen-lieu', [NguyenLieuController::class, 'createNguyenLieu']);
        Route::delete('/xoa-nguyen-lieu/{id}', [NguyenLieuController::class, 'xoaNguyenLieu']);
        Route::put('/cap-nhat-nguyen-lieu', [NguyenLieuController::class, 'capNhatNguyenLieu']);
        Route::put('/doi-trang-thai', [NguyenLieuController::class, 'doiTrangThaiNguyenLieu']);

        Route::post('/kiem-tra-slug', [NguyenLieuController::class, 'kiemTraSlugNguyenLieu']);
        Route::post('/kiem-tra-slug-update', [NguyenLieuController::class, 'kiemTraSlugNguyenLieuUpdate']);
    });

    Route::group(['prefix'  =>  '/nhap-kho'], function () {
        Route::get('/lay-du-lieu', [NhapKhoController::class, 'getData']);
        Route::post('/them-nguyen-lieu', [NhapKhoController::class, 'addNguyenLieu']);
        Route::delete('/xoa-nguyen-lieu/{id}', [NhapKhoController::class, 'xoaNguyenLieu']);
        Route::put('/cap-nhat-nhap-kho', [NhapKhoController::class, 'updateNhapKho']);
    });
    Route::group(['prefix'  =>  '/nha-cung-cap'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [NhaCungCapController::class, 'getData']);
        Route::post('/tim-nha-cung-cap', [NhaCungCapController::class, 'searchNhaCungCap']);
        Route::post('/tao-nha-cung-cap', [NhaCungCapController::class, 'createNhaCungCap']);
        Route::delete('/xoa-nha-cung-cap/{id}', [NhaCungCapController::class, 'xoaNhaCungCap']);
        Route::put('/cap-nhat-nha-cung-cap', [NhaCungCapController::class, 'capNhatNhaCungCap']);
        Route::put('/doi-trang-thai', [NhaCungCapController::class, 'doiTrangThaiNhaCungCap']);
    });
    Route::group(['prefix'  =>  '/mon-an'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [MonAnController::class, 'getData']);
        Route::post('/tim-mon-an', [MonAnController::class, 'searchMonAn']);
        Route::post('/tao-mon-an', [MonAnController::class, 'createMonAn']);
        Route::delete('/xoa-mon-an/{id}', [MonAnController::class, 'xoaMonAn']);
        Route::put('/cap-nhat-mon-an', [MonAnController::class, 'capNhatMonAn']);
        Route::put('/doi-trang-thai', [MonAnController::class, 'doiTrangThaiMonAn']);

        Route::post('/kiem-tra-slug', [MonAnController::class, 'kiemTraSlugMonAn']);
        Route::post('/kiem-tra-slug-update', [MonAnController::class, 'kiemTraSlugMonAnUpdate']);
    });
    Route::group(['prefix'  =>  '/chuyen-muc'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [ChuyenMucTinTucController::class, 'getData']);
        Route::post('/tim-chuyen-muc', [ChuyenMucTinTucController::class, 'searchChuyenMuc']);
        Route::post('/tao-chuyen-muc', [ChuyenMucTinTucController::class, 'createChuyenMuc']);
        Route::delete('/xoa-chuyen-muc/{id}', [ChuyenMucTinTucController::class, 'xoaChuyenMuc']);
        Route::put('/cap-nhat-chuyen-muc', [ChuyenMucTinTucController::class, 'capNhatChuyenMuc']);
        Route::put('/doi-trang-thai', [ChuyenMucTinTucController::class, 'doiTrangThaiChuyenMuc']);

        Route::post('/kiem-tra-slug', [ChuyenMucTinTucController::class, 'kiemTraSlugChuyenMuc']);
        Route::post('/kiem-tra-slug-update', [ChuyenMucTinTucController::class, 'kiemTraSlugChuyenMucUpdate']);
    });

    Route::group(['prefix'  =>  '/tin-tuc'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [TinTucController::class, 'getData']);
        Route::post('/tim-tin-tuc', [TinTucController::class, 'searchTinTuc']);
        Route::post('/tao-tin-tuc', [TinTucController::class, 'createTinTuc']);
        Route::delete('/xoa-tin-tuc/{id}', [TinTucController::class, 'xoaTinTuc']);
        Route::put('/cap-nhat-tin-tuc', [TinTucController::class, 'capNhatTinTuc']);
        Route::put('/doi-trang-thai', [TinTucController::class, 'doiTrangThaiTinTuc']);
    });
    Route::group(['prefix'  =>  '/hoa-don-dich-vu'], function () {
        Route::post('/mo-ban', [HoaDonKhachHangController::class, 'moBan']); 
        Route::get('/lay-du-lieu-mon-an', [HoaDonKhachHangController::class, 'getmonAn']); 

    });
});
