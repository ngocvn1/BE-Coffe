<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\TinTuc;
use Illuminate\Http\Request;

class TrangChuController extends Controller
{
    public function viewSanPham(){
        $sanPham = SanPham::get();
        return response()->json([
            'data'   => $sanPham,
        ]);
    }
    public function viewBaiViet(){
        $tinTuc = TinTuc::join('khach_hangs','khach_hangs.id','tin_tucs.id_user')->select('tin_tucs.*','khach_hangs.ho_va_ten')->get();
        return response()->json([
            'data'   => $tinTuc,
        ]);
    }
}
