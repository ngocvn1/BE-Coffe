<?php

namespace App\Http\Controllers;

use App\Models\MonAn;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MonAnController extends Controller
{
    public function getData()
    {
        $data   = MonAn::join('danh_mucs', 'danh_mucs.id', 'mon_ans.id_danh_muc')
            ->select('mon_ans.*', 'danh_mucs.ten_danh_muc')
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'mon_an'  =>  $data,
        ]);
    }
    public function createMonAn(Request $request)
    {
        MonAn::create([
            'ten_mon'       => $request->ten_mon,
            'slug_mon'      => $request->slug_mon,
            'hinh_anh'      => $request->hinh_anh,
            'gia_ban'       => $request->gia_ban,
            'tinh_trang'    => $request->tinh_trang,
            'id_danh_muc'   => $request->id_danh_muc,
        ]);
        return response()->json([
            'status'    => true,
            'message'   => 'Tạo món ăn thành công!',
        ]);
    }
    public function searchMonAn(Request $request)
    {
        $key = "%" . $request->abc . "%";

        $data   = MonAn::join('danh_mucs', 'danh_mucs.id', 'mon_ans.id_danh_muc')
            ->where('mon_ans.ten_mon', 'like', $key)
            ->select('mon_ans.*', 'danh_mucs.ten_danh_muc')
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'mon_an'  =>  $data,
        ]);
    }
    public function xoaMonAn($id)
    {
        try {
            MonAn::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa món ăn nhập kho thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function capNhatMonAn(Request $request)
    {
        try {
            MonAn::where('id', $request->id)
                ->update([
                    'ten_mon'       => $request->ten_mon,
                    'slug_mon'      => $request->slug_mon,
                    'hinh_anh'      => $request->hinh_anh,
                    'gia_ban'       => $request->gia_ban,
                    'id_danh_muc'   => $request->id_danh_muc,
                    'tinh_trang'    => $request->tinh_trang,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công món ' . $request->ten_mon,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function doiTrangThaiMonAn(Request $request)
    {
        try {
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            MonAn::where('id', $request->id)
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

    public function kiemTraSlugMonAn(Request $request)
    {
        $mon_an = MonAn::where('slug_mon', $request->slug)->first();

        if(!$mon_an) {
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Tên Món Ăn phù hợp!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Tên Món Ăn Đã Tồn Tại!',
            ]);
        }
    }

    public function kiemTraSlugMonAnUpdate(Request $request)
    {
        $mon_an = MonAn::where('slug_mon', $request->slug)
                                     ->where('id', '<>' , $request->id)
                                     ->first();

        if(!$mon_an) {
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Tên Món Ăn phù hợp!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Tên Món Ăn Đã Tồn Tại!',
            ]);
        }
    }
}
