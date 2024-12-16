<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifyEmail($token)
    {
        // Tìm người dùng có token xác thực tương ứng
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Token không hợp lệ hoặc đã hết hạn.'], 404);
        }

        // Cập nhật trạng thái người dùng thành 'is_active = 1'
        $user->is_active = 1;
        $user->verification_token = null; // Xóa token sau khi đã xác thực
        $user->save();

        return view('emails.successverify', ['user' => $user]);
    }
}


