<?php

namespace App\Http\Controllers;

use App\Models\NhaCungCap;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NhaCungCapController extends Controller
{
    public function getData()
    {
        $data = NhaCungCap::get();
        return response()->json([
            'nha_cung_cap'   => $data,
        ]);
    }
    public function searchNhaCungCap(Request $request)
    {
        $key = '%' . $request->abc . '%';

        $data   = NhaCungCap::where('ten_cong_ty', 'like', $key)
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'nha_cung_cap'  =>  $data,
        ]);
    }
    public function createNhaCungCap(Request $request)
    {
        NhaCungCap::create([
            'ma_so_thue'            => $request->ma_so_thue,
            'ten_cong_ty'           => $request->ten_cong_ty,
            'ten_nguoi_dai_dien'    => $request->ten_nguoi_dai_dien,
            'so_dien_thoai'         => $request->so_dien_thoai,
            'email'                 => $request->email,
            'dia_chi'               => $request->dia_chi,
            'ten_goi_nho'           => $request->ten_goi_nho,
            'tinh_trang'            => $request->tinh_trang,
        ]);
        return response()->json([
            'status'    => true,
            'message'   => 'Tạo mới nhà cung cấp thành công!',
        ]);
    }
    public function xoaNhaCungCap($id)
    {
        try {
            NhaCungCap::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa nhà cung cấp thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function capNhatNhaCungCap(Request $request)
    {
        try {
            NhaCungCap::where('id', $request->id)
                ->update([
                    'ten_cong_ty'           => $request->ten_cong_ty,
                    'ma_so_thue'            => $request->ma_so_thue,
                    'ten_nguoi_dai_dien'    => $request->ten_nguoi_dai_dien,
                    'so_dien_thoai'         => $request->so_dien_thoai,
                    'email'                 => $request->email,
                    'dia_chi'               => $request->dia_chi,
                    'ten_goi_nho'           => $request->ten_goi_nho,
                    'tinh_trang'            => $request->tinh_trang,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công công ty ' . $request->ten_cong_ty,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function doiTrangThaiNhaCungCap(Request $request)
    {
        try {
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            NhaCungCap::where('id', $request->id)
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
