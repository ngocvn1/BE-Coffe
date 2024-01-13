<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\HoaDonKhachHang;
use App\Models\MonAn;
use Illuminate\Http\Request;

class HoaDonKhachHangController extends Controller
{
    public function moBan(Request $request)
    {
        $hoaDon = HoaDonKhachHang::create([
            'id_ban' => $request->id
        ]);
        if($hoaDon){
           $ban =  Ban::where('id', $request->id)->first();
           $ban->is_mo_ban = 1;
           $ban->save();
        }
        return response()->json([
            'status'    => 1,
            'message'   => 'Mở bàn thành công!',
        ]);
    }

    public function getMonAn(){
        $monan   = MonAn::join('danh_mucs', 'danh_mucs.id', 'mon_ans.id_danh_muc')
                        ->select('mon_ans.*', 'danh_mucs.ten_danh_muc')
                        ->get(); // get là ra 1 danh sách

        return response()->json([
            'data'  =>  $monan,
        ]);
    }        
}
