<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BanController extends Controller
{
    public function index()
    {
        return view('ban');
    }

    public function getData()
    {
        $data   = Ban::join('khu_vucs', 'khu_vucs.id', 'bans.id_khu_vuc')
            ->select('bans.*', 'khu_vucs.ten_khu')
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'ban'  =>  $data,
        ]);
    }

    public function searchBan(Request $request)
    {
        $key = "%" . $request->abc . "%";

        $data   = Ban::join('khu_vucs', 'khu_vucs.id', 'bans.id_khu_vuc')
            ->where('bans.ten_ban', 'like', $key)
            ->select('bans.*', 'khu_vucs.ten_khu')
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'ban'  =>  $data,
        ]);
    }

    public function createBan(Request $request)
    {
        $ban = Ban::where('slug_ban', $request->slug_ban)
                  ->where('id_khu_vuc', $request->id_khu_vuc)
                  ->first();

        if($ban) {
            return response()->json([
                'status'    => false,
                'message'   => 'Bàn này đã tồn tại trong khu vực!'
            ]);
        }

        Ban::create([
            'ten_ban'      => $request->ten_ban,
            'slug_ban'     => $request->slug_ban,
            'id_khu_vuc'   => $request->id_khu_vuc,
            'tinh_trang'   => $request->tinh_trang,
        ]);

        return response()->json([
            'status'            =>   true,
            'message'           =>   'Đã tạo mới bàn thành công!',
        ]);
    }
    public function xoaBan($id)
    {
        try {
            Ban::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa bàn thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function capNhatBan(Request $request)
    {
        try {
            $ban = Ban::where('slug_ban', $request->slug_ban)
                        ->where('id_khu_vuc', $request->id_khu_vuc)
                        ->where('id', "<>", $request->id)
                        ->first();

            if($ban) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Bàn này đã tồn tại trong khu vực!'
                ]);
            }

            Ban::where('id', $request->id)
                ->update([
                    'ten_ban'           => $request->ten_ban,
                    'slug_ban'          => $request->slug_ban,
                    'id_khu_vuc'        => $request->id_khu_vuc,
                    'tinh_trang'        => $request->tinh_trang,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công ' . $request->ten_ban,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function doiTrangThaiBan(Request $request)
    {
        try {
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            Ban::where('id', $request->id)
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
