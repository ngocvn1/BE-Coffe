<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SanPhamController extends Controller
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
        $sanPham = SanPham::join('khach_hangs', 'san_phams.id_user', 'khach_hangs.id')
            ->select('san_phams.*','khach_hangs.ho_va_ten')->get();
        return response()->json([
            'data'   => $sanPham,
        ]);
    }
    public function createSanPham(Request $request)
    {
        $check = Auth::guard('sanctum')->check();
        if ($check == false) {
            return response()->json([
                'status'    =>  0,
                'message'   =>  'Bạn chưa login!',
            ], 401);
        }
        $user = Auth::guard('sanctum')->user();
        SanPham::create([
            'ten_san_pham'      => $request->ten_san_pham,
            'slug_san_pham'     => $request->slug_san_pham,
            'gia_ban'           => $request->gia_ban,
            'gia_khuyen_mai'    => $request->gia_khuyen_mai,
            'so_luong'          => $request->so_luong,
            'hinh_anh'          => $request->hinh_anh,
            'mo_ta'             => $request->mo_ta,
            'is_open'           => $request->is_open,
            'id_user'           => $user->id,
        ]);
        return response()->json([
            'status'    => true,
            'message'   => 'Tạo Sản Phẩm Thành Công !',
        ]);
    }
    public function capNhatSanPham(Request $request)
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
            SanPham::where('id', $request->id)->update([
                'ten_san_pham'      => $request->ten_san_pham,
                'slug_san_pham'     => $request->slug_san_pham,
                'gia_ban'           => $request->gia_ban,
                'gia_khuyen_mai'    => $request->gia_khuyen_mai,
                'so_luong'          => $request->so_luong,
                'hinh_anh'          => $request->hinh_anh,
                'mo_ta'             => $request->mo_ta,
                'is_open'           => $request->is_open,
                'id_user'           => $user->id,
            ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công sản phẩm ' . $request->ten_san_pham,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function xoaSanPham($id){
        try {
            SanPham::where('id',$id)->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã xóa sản phẩm thành công !',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function doiTrangThaiSanPham(Request $request){
        try {
            if ($request->is_open == 1) {
                $is_open_new = 0;
            } else {
                $is_open_new = 1;
            }
            SanPham::where('id', $request->id)
                ->update([
                    'is_open'  => $is_open_new,
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
