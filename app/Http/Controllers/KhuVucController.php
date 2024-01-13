<?php

namespace App\Http\Controllers;

use App\Models\KhuVuc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class KhuVucController extends Controller
{
    public function index()
    {
        return view('khu_vuc');
    }

    public function getData()
    {
        $data   = KhuVuc::get(); // get là ra 1 danh sách

        return response()->json([
            'khu_vuc'  =>  $data,
        ]);
    }

    public function getDataHoatDong()
    {
        $data   = KhuVuc::where('tinh_trang', 1)->get(); // get là ra 1 danh sách

        return response()->json([
            'khu_vuc'  =>  $data,
        ]);
    }

    public function searchKhuVuc(Request $request)
    {
        $key = "%" . $request->abc . "%";

        $data   = KhuVuc::where('ten_khu', 'like', $key)
                         ->get(); // get là ra 1 danh sách

        return response()->json([
            'khu_vuc'  =>  $data,
        ]);
    }

    public function createKhuVuc(Request $request)
    {
        KhuVuc::create([
            'ten_khu'           => $request->ten_khu,
            'slug_khu'          => $request->slug_khu,
            'tinh_trang'        => $request->tinh_trang,
        ]);

        return response()->json([
            'status'            =>   true,
            'message'           =>   'Đã tạo mới khu vực thành công!',
        ]);
    }

    public function xoaKhuVuc($id){
        try {
            KhuVuc::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa khu vực thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function capNhatKhuVuc(Request $request)
    {
        try {
            KhuVuc::where('id', $request->id)
                  ->update([
                    'ten_khu'       => $request->ten_khu,
                    'slug_khu'      => $request->slug_khu,
                    'tinh_trang'    => $request->tinh_trang,
                  ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật tên khu thành ' . $request->ten_khu,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function doiTrangThaiKhuVuc(Request $request)
    {
        try {
            if($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            KhuVuc::where('id', $request->id)
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

    public function kiemTraSlugKhuVuc(Request $request)
    {
        $khu_vuc = KhuVuc::where('slug_khu', $request->slug)->first();

        if(!$khu_vuc) {
            return response()->json([
                'status'    => true,
                'message'   => 'Tên Khu Vực có thể dùng được!'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Tên Khu Vực đã tồn tại!'
            ]);
        }
    }

    public function kiemTraSlugKhuVucUpdate(Request $request)
    {
        $chuyen_muc = KhuVuc::where('slug_khu', $request->slug)
                                     ->where('id', '<>' , $request->id)
                                     ->first();

        if(!$chuyen_muc) {
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Tên Khu Vực phù hợp!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Tên Khu Vực Đã Tồn Tại!',
            ]);
        }
    }
}
