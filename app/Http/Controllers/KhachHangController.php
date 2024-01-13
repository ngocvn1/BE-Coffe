<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;

class KhachHangController extends Controller
{
    public function login(Request $request)
    {
        $check  = Auth::guard('nhan_vien')->attempt(['email' => $request->email, 'password' => $request->password]);
        // check sẽ trả về true hoặc false
        if ($check == true) {  // có
            // Lấy thông tin người đã nhập
            $user  = Auth::guard('nhan_vien')->user();
            $token = $user->createToken('api-token-longmap')->plainTextToken;
            return response()->json([
                'message'   =>  'Ok, đã đăng nhập rồi nghen!',
                'status'    =>  true,
                'token'     =>  $token,
                'user'      =>  $user,
            ]);
        } else {
            return response()->json([
                'message'   =>  'Đăng nhập thất bại!',
                'status'    =>  false
            ]);
        }
    }

    public function register(Request $request)
    {
        $user = KhachHang::where('email', $request->email)->first();

        if($user) {
            return response()->json([
                'message'   =>  'Email đã tồn tại trong hệ thống!',
                'status'    =>  false
            ]);
        }

        KhachHang::create([
            'email'         =>  $request->email,
            'ho_va_ten'     =>  $request->ho_va_ten,
            'password'      =>  bcrypt($request->password),
        ]);

        return response()->json([
            'message'   =>  'Tao tại tài khoản rồi nhé!',
            'status'    =>  true
        ]);
    }

    public function check(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if ($user) {
            $agent = new Agent();
            $device     = $agent->device();
            $os         = $agent->platform();
            $browser    = $agent->browser();
            DB::table('personal_access_tokens')
                ->where('id', $user->currentAccessToken()->id)
                ->update([
                    'ip'            =>  request()->ip(),
                    'device'        =>  $device,
                    'os'            =>  $os,
                    'trinh_duyet'   =>  $browser,
                ]);
            return response()->json([
                'email'     =>  $user->email,
                'ho_ten'    =>  $user->ho_va_ten,
                'list'      =>  $user->tokens,
            ], 200);
        } else {
            return response()->json([
                'message'   =>  'Bạn cần đăng nhập hệ thống',
                'status'    =>  false,
            ], 401);
        }
    }

    public function removeToken($id)
    {
        try {
            DB::table('personal_access_tokens')
                ->where('id', $id)
                ->delete();
            return response()->json([
                'message'   =>  'Đã remove Token thành công !',
                'status'    =>  true,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
        }
    }

    public function test()
    {
        $ip = request()->ip();

        // dd($ip, $device, $os, $browser);
    }
}
