<?php

namespace App\Http\Controllers;

use App\Models\NhapKho;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NhapKhoController extends Controller
{
    public function index()
    {
        return view('nhap_kho');
    }

    public function getData()
    {
        $data   = NhapKho::join('nguyen_lieus', 'id_nguyen_lieu', 'nguyen_lieus.id')
                         ->select('nhap_khos.*', 'nguyen_lieus.ten_nguyen_lieu')
                         ->get(); // get là ra 1 danh sách
        return response()->json([
            'nhap_kho'  =>  $data,
        ]);
    }
    public function addNguyenLieu(Request $request){
        NhapKho::create([
            'id_nguyen_lieu'=>$request->id,
        ]);
        return response()->json([
            'status'            =>   true,
            'message'           =>   'Thêm nguyên liệu thành công!',
        ]);
    }
    public function xoaNguyenLieu($id){
        try {
            NhapKho::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa nguyên liệu nhập kho thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function updateNhapKho(Request $request)
    {
        $nhap_kho = NhapKho::where('id', $request->id)->first();

        if($nhap_kho) {
            $nhap_kho->update([
                'so_luong'      => $request->so_luong,
                'don_gia'       => $request->don_gia,
                'thanh_tien'    => $request->so_luong * $request->don_gia,
            ]);

            return response()->json([
                'status'            =>   true,
                'message'           =>   'Cập Nhật Thành Công!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi của hệ thống!',
            ]);
        }
    }
}
