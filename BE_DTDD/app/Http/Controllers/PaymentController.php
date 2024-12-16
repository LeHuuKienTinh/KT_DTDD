<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Tạo mã order_code tự động
        $orderCode = 'ORDER-' . now()->format('YmdHis') . '-' . Str::random(6);


        $payment = Payment::create([
            'order_code' => $orderCode,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Đặt hàng thành công! Vui lòng chờ xác nhận thanh toán!',
            'data' => $payment,
        ]);
    }
}
