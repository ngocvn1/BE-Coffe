<?php

namespace App\Http\Controllers;

use App\Models\ChucVu;
use App\Models\DanhMuc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DanhMucController extends Controller
{
    public function index()
    {
        return view('danh_muc');
    }

    public function getData()
    {
        $check = Auth::guard('sanctum')->check();
        if($check == false) {
            return response()->json([
                'status'    =>  0,
                'message'   =>  'Bạn chưa login!',
            ], 401);
        }

        $data   = DanhMuc::select('id', 'ten_danh_muc', 'slug_danh_muc', 'tinh_trang', 'id_danh_muc_cha')
                         ->get(); // get là ra 1 danh sách

        return response()->json([
            'danh_muc'  =>  $data,
        ]);
    }

    public function searchDanhMuc(Request $request)
    {
        $key = "%" . $request->abc . "%";

        $data   = DanhMuc::select('id', 'ten_danh_muc', 'slug_danh_muc', 'tinh_trang', 'id_danh_muc_cha')
            ->where('ten_danh_muc', 'like', $key)
            ->get();

        return response()->json([
            'danh_muc'  =>  $data,
        ]);
    }

    public function createDanhMuc(Request $request)
    {
        DanhMuc::create([
            'ten_danh_muc'      => $request->ten_danh_muc,
            'slug_danh_muc'     => $request->slug_danh_muc,
            'id_danh_muc_cha'   => $request->id_danh_muc_cha,
            'tinh_trang'        => $request->tinh_trang,
        ]);

        return response()->json([
            'status'            =>   true,
            'message'           =>   'Đã tạo mới danh mục thành công!',
        ]);
    }
    public function xoaDanhMuc($id)
    {
        try {
            DanhMuc::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa danh mục thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function capNhatDanhMuc(Request $request)
    {
        try {
            DanhMuc::where('id', $request->id)
                ->update([
                    'ten_danh_muc'       => $request->ten_danh_muc,
                    'slug_danh_muc'      => $request->slug_danh_muc,
                    'id_danh_muc_cha'    => $request->id_danh_muc_cha,
                    'tinh_trang'         => $request->tinh_trang,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công danh mục ' . $request->ten_danh_muc,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function doiTrangThaiDanhMuc(Request $request)
    {
        try {
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            DanhMuc::where('id', $request->id)
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

    public function kiemTraSlugDanhMuc(Request $request)
    {
        $danh_muc = DanhMuc::where('slug_danh_muc', $request->slug)->first();

        if(!$danh_muc) {
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Tên Danh Mục phù hợp!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Tên Danh Mục Đã Tồn Tại!',
            ]);
        }
    }
}
