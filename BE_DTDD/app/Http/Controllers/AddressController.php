<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function getData()
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn cần đăng nhập để thêm địa chỉ',
            ], 401);
        }
        $data = Address::where('user_id', $user->id)
            ->orderBy('is_default', 'desc')
            ->get();
        $default = Address::where('user_id', $user->id)
            ->where('is_default', 1)
            ->first();
        if (!$default) {
            return response()->json([
                'status' => true,
                'data' => $data,
                'default' => null, // Không có địa chỉ mặc định
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $data,
            'default' => $default
        ]);
    }

    public function createAddress(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn cần đăng nhập để thêm địa chỉ',
            ], 401);
        }
        Address::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'district' => $request->district,
            'city' => $request->province
        ])->save();
        return response()->json([
            'status' =>true,
            'message' => 'Thêm mới địa chỉ thành công!'
        ]);
    }

    public function updateDefault(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn cần đăng nhập để thêm địa chỉ',
            ], 401);
        }
        $address_default = Address::where('user_id', $user->id)->find($request->id);
        Address::where('user_id', $user->id)->update([
            'is_default' => 0,
        ]);
        $address_default->is_default = 1;
        $address_default->save();
        return response()->json([
        'status' => true,
        'data' => $address_default,
        'message' => 'Thay đổi địa chỉ giao hàng thành công!',
        ]);
    }
}
