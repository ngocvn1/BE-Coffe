<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NhanVienController extends Controller
{
    public function index()
    {
        return view('nhan_vien');
    }

    public function getData()
    {
        $data   = NhanVien::join('chuc_vus', 'chuc_vus.id', 'nhan_viens.id_chuc_vu')
            ->select('nhan_viens.*', 'chuc_vus.ten_chuc_vu')
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'nhan_vien'  =>  $data,
        ]);
    }

    public function searchNhanVien(Request $request)
    {
        $key = "%" . $request->abc . "%";

        $data   = NhanVien::join('chuc_vus', 'chuc_vus.id', 'nhan_viens.id_chuc_vu')
            ->where('nhan_viens.ho_va_ten', 'like', $key)
            ->select('nhan_viens.*', 'chuc_vus.ten_chuc_vu')
            ->get();

        return response()->json([
            'nhan_vien'  =>  $data,
        ]);
    }

    public function createNhanVien(Request $request)
    {
        $nhan_vien = NhanVien::where('email', $request->email)->first();
        if($nhan_vien) {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Email này đã tồn tại trên hệ thống!',
            ]);
        }

        NhanVien::create([
            'ho_va_ten'         => $request->ho_va_ten,
            'email'             => $request->email,
            'password'          => $request->password,
            'so_dien_thoai'     => $request->so_dien_thoai,
            'dia_chi'           => $request->dia_chi,
            'id_chuc_vu'        => $request->id_chuc_vu,
            'tinh_trang'        => $request->tinh_trang,
        ]);

        return response()->json([
            'status'            =>   true,
            'message'           =>   'Đã tạo mới nhân viên thành công!',
        ]);
    }
    public function xoaNhanVien($id)
    {
        try {
            NhanVien::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa nhân viên thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function capNhatNhanVien(Request $request)
    {
        try {
            NhanVien::where('id', $request->id)
                ->update([
                    'ho_va_ten'         => $request->ho_va_ten,
                    'email'             => $request->email,
                    'password'          => $request->password,
                    'so_dien_thoai'     => $request->so_dien_thoai,
                    'dia_chi'           => $request->dia_chi,
                    'id_chuc_vu'        => $request->id_chuc_vu,
                    'tinh_trang'        => $request->tinh_trang,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công nhân viên ' . $request->ho_va_ten,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function doiTrangThaiNhanVien(Request $request)
    {
        try {
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            NhanVien::where('id', $request->id)
                ->update([
                    'tinh_trang'  => $tinh_trang_moi,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã đổi trạng thái thành công',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
}
