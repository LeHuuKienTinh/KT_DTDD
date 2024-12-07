<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Đăng nhập và tạo access_token
    public function login(Request $request)
    {
        // Validate dữ liệu từ Client
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ]);

        // Kiểm tra dữ liệu nếu không hợp lệ
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->toArray()], 422);
        }

        // Kiểm tra thông tin đăng nhập
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Thông tin đăng nhập không chính xác'], 401);
        }

        // Lấy thông tin người dùng đã đăng nhập
        $user = Auth::user();

        // Kiểm tra tài khoản đã được kích hoạt chưa
        if (!$user->is_active) {
            return response()->json(['message' => 'Tài khoản chưa được kích hoạt'], 403);
        }

        // Tạo access token
        $token = $user->createToken('access_token')->plainTextToken;

        return response()->json([
            'message' => 'Đăng nhập thành công',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ], 200);
    }

    // Đăng ký người dùng và trả về access_token
    public function register(Request $request)
    {
        // Validate dữ liệu từ Client trước khi lưu
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|numeric|unique:users,phone_number',
            'password' => 'required|min:6'
        ], [
            'name.required' => 'Vui lòng nhập tên đúng',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã được sử dụng.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'phone_number.unique' => 'Số điện thoại đã được sử dụng.',
        ]);

        // Kiểm tra dữ liệu nếu không hợp lệ
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        // Tạo người dùng mới và mã hóa mật khẩu
        $user = User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Tạo access token ngay sau khi đăng ký thành công
        $token = $user->createToken('access_token')->plainTextToken;

        return response()->json([
            'message' => "Đăng ký tài khoản thành công!",
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 201);
    }

    // Kiểm tra trạng thái đăng nhập dựa vào access_token
    public function checkLogin(Request $request)
    {
        $khach_hang = Auth::guard('sanctum')->user();
        if($khach_hang) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Vui lòng đăng nhập"
            ],401);
        }
    }

    // Đăng xuất và thu hồi token
    public function logout(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if(!$user){
            return response()->json([
                'status'  => false,
                'mesage' => 'Lỗi xác thực đăng nhập khi đăng xuất'
            ]);
        } else {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'status' => true,
                'message' => 'Đăng xuất thành công'
            ]);
        }
    }

    //Profile User
    public function dataUser(Request $request)
{
    $user = $request->user();
    return response()->json([
        'status' => true,
        'info' => [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'phone' => $user->phone_number,
        // Các thông tin cần thiết khác
    ]
    ]);
}


    //Update info user
    public function updateUser(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if($user){
            User::where('id', $user->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật thông tin thành công'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi xác thực đăng nhập'
            ]);
        }
    }
}
