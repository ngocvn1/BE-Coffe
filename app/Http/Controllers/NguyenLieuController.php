<?php

namespace App\Http\Controllers;

use App\Models\NguyenLieu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NguyenLieuController extends Controller
{
    public function index()
    {
        return view('nguyen_lieu');
    }

    public function getData()
    {
        $data   = NguyenLieu::select('id',  'ten_nguyen_lieu', 'slug_nguyen_lieu', 'so_luong', 'gia', 'dvt', 'tinh_trang')
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'nguyen_lieu'  =>  $data,
        ]);
    }

    public function searchNguyenLieu(Request $request)
    {
        $key = '%' . $request->abc . '%';

        $data   = NguyenLieu::where('ten_nguyen_lieu', 'like', $key)
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'nguyen_lieu'  =>  $data,
        ]);
    }

    public function createNguyenLieu(Request $request)
    {
        NguyenLieu::create([
            'ten_nguyen_lieu'       => $request->ten_nguyen_lieu,
            'slug_nguyen_lieu'      => $request->slug_nguyen_lieu,
            'so_luong'              => $request->so_luong,
            'gia'                   => $request->gia,
            'dvt'                   => $request->dvt,
            'tinh_trang'            => $request->tinh_trang,
        ]);

        return response()->json([
            'status'            =>   true,
            'message'           =>   'Đã tạo mới nguyên liệu thành công!',
        ]);
    }
    public function xoaNguyenLieu($id)
    {
        try {
            NguyenLieu::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa nguyên liệu thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function capNhatNguyenLieu(Request $request)
    {
        try {
            NguyenLieu::where('id', $request->id)
                ->update([
                    'ten_nguyen_lieu'       => $request->ten_nguyen_lieu,
                    'slug_nguyen_lieu'      => $request->slug_nguyen_lieu,
                    'so_luong'              => $request->so_luong,
                    'gia'                   => $request->gia,
                    'dvt'                   => $request->dvt,
                    'tinh_trang'            => $request->tinh_trang,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công nguyên liệu ' . $request->ten_nguyen_lieu,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function doiTrangThaiNguyenLieu(Request $request)
    {
        try {
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            NguyenLieu::where('id', $request->id)
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

    public function kiemTraSlugNguyenLieu(Request $request)
    {
        $nguyen_lieu = NguyenLieu::where('slug_nguyen_lieu', $request->slug)->first();

        if(!$nguyen_lieu) {
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Tên Nguyên Liệu phù hợp!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Tên Nguyên Liệu Đã Tồn Tại!',
            ]);
        }
    }

    public function kiemTraSlugNguyenLieuUpdate(Request $request)
    {
        $chuyen_muc = NguyenLieu::where('slug_nguyen_lieu', $request->slug)
                                     ->where('id', '<>' , $request->id)
                                     ->first();

        if(!$chuyen_muc) {
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Tên Nguyên Liệu phù hợp!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Tên Nguyên Liệu Đã Tồn Tại!',
            ]);
        }
    }
}
