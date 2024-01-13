<?php

namespace App\Http\Controllers;

use App\Models\TinTuc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TinTucController extends Controller
{
    public function getData()
    {
        $check = Auth::guard('sanctum')->check();
        if ($check == false) {
            return response()->json([
                'status'    =>  0,
                'message'   =>  'Bạn chưa login!',
            ], 401);
        }
        $user = Auth::guard('sanctum')->user();
        $data   = TinTuc::join('chuyen_muc_tin_tucs', 'chuyen_muc_tin_tucs.id', 'tin_tucs.id_chuyen_muc_tin_tuc')
            ->select('tin_tucs.*', 'chuyen_muc_tin_tucs.ten_chuyen_muc')
            ->get();

        return response()->json([
            'tin_tuc'  =>  $data,
        ]);
    }
    public function createTinTuc(Request $request)
    {
        $check = Auth::guard('sanctum')->check();
        if ($check == false) {
            return response()->json([
                'status'    =>  0,
                'message'   =>  'Bạn chưa login!',
            ], 401);
        }
        $user = Auth::guard('sanctum')->user();

        $tin_tuc = TinTuc::where('slug_tin_tuc', $request->slug_tin_tuc)
                         ->where('id_chuyen_muc_tin_tuc', $request->id_chuyen_muc_tin_tuc)
                         ->first();

        if($tin_tuc) {
            return response()->json([
                'status'    => false,
                'message'   => 'Tiêu đề bài viết đã tồn tại trong Chuyên Mục!',
            ]);
        }

        TinTuc::create([
            'tieu_de_tin_tuc'          => $request->tieu_de_tin_tuc,
            'slug_tin_tuc'             => $request->slug_tin_tuc,
            'hinh_anh_tin_tuc'         => $request->hinh_anh_tin_tuc,
            'mo_ta_ngan_tin_tuc'       => $request->mo_ta_ngan_tin_tuc,
            'mo_ta_chi_tiet_tin_tuc'   => $request->mo_ta_chi_tiet_tin_tuc,
            'id_chuyen_muc_tin_tuc'    => $request->id_chuyen_muc_tin_tuc,
            'tinh_trang'               => $request->tinh_trang,
            'id_user'                  => $user->id
        ]);
        return response()->json([
            'status'    => true,
            'message'   => 'Tạo tin tức thành công!',
        ]);
    }
    public function searchTinTuc(Request $request)
    {
        $key = "%" . $request->abc . "%";
        $check = Auth::guard('sanctum')->check();
        if ($check == false) {
            return response()->json([
                'status'    =>  0,
                'message'   =>  'Bạn chưa login!',
            ], 401);
        }
        $user = Auth::guard('sanctum')->user();
        $data   = TinTuc::join('chuyen_muc_tin_tucs', 'chuyen_muc_tin_tucs.id', 'tin_tucs.id_chuyen_muc_tin_tuc')
            ->where('tin_tucs.tieu_de_tin_tuc', 'like', $key)
            ->select('tin_tucs.*', 'chuyen_muc_tin_tucs.ten_chuyen_muc')
            ->get();

        return response()->json([
            'tin_tuc'  =>  $data,
        ]);
    }
    public function xoaTinTuc($id)
    {
        try {
            $check = Auth::guard('sanctum')->check();
            if ($check == false) {
                return response()->json([
                    'status'    =>  0,
                    'message'   =>  'Bạn chưa login!',
                ], 401);
            }
            $user = Auth::guard('sanctum')->user();
            TinTuc::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa tin tức thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function capNhatTinTuc(Request $request)
    {

        try {
            $check = Auth::guard('sanctum')->check();
            if ($check == false) {
                return response()->json([
                    'status'    =>  0,
                    'message'   =>  'Bạn chưa login!',
                ], 401);
            }

            $user = Auth::guard('sanctum')->user();

            $tin_tuc = TinTuc::where('slug_tin_tuc', $request->slug_tin_tuc)
                         ->where('id_chuyen_muc_tin_tuc', $request->id_chuyen_muc_tin_tuc)
                         ->where('id', '<>', $request->id)
                         ->first();

            if($tin_tuc) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Tiêu đề bài viết đã tồn tại trong Chuyên Mục!',
                ]);
            }

            TinTuc::where('id', $request->id)
                ->update([
                    'tieu_de_tin_tuc'          => $request->tieu_de_tin_tuc,
                    'slug_tin_tuc'             => $request->slug_tin_tuc,
                    'hinh_anh_tin_tuc'         => $request->hinh_anh_tin_tuc,
                    'mo_ta_ngan_tin_tuc'       => $request->mo_ta_ngan_tin_tuc,
                    'mo_ta_chi_tiet_tin_tuc'   => $request->mo_ta_chi_tiet_tin_tuc,
                    'id_chuyen_muc_tin_tuc'    => $request->id_chuyen_muc_tin_tuc,
                    'tinh_trang'               => $request->tinh_trang,
                    'id_user'                  => $user->id
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công ' . $request->tieu_de_tin_tuc,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function doiTrangThaiTinTuc(Request $request)
    {
        try {
            $check = Auth::guard('sanctum')->check();
            if ($check == false) {
                return response()->json([
                    'status'    =>  0,
                    'message'   =>  'Bạn chưa login!',
                ], 401);
            }
            $user = Auth::guard('sanctum')->user();
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            TinTuc::where('id', $request->id)
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
