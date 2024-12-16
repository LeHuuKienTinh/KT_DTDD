<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Lấy thông tin người dùng
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn cần đăng nhập để thêm vào giỏ hàng.',
            ], 401);
        }

        // Validate dữ liệu đầu vào
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Tìm sản phẩm trong database
        $product = Product::find($validated['product_id']);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Sản phẩm không tồn tại.',
            ], 404);
        }

        // Lấy giá sản phẩm từ database
        $price = $product->price;

        // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $validated['product_id'])
            ->first();

        try {
            if ($cartItem) {
                // Nếu sản phẩm đã tồn tại, tăng số lượng
                $cartItem->quantity += $validated['quantity'];
                $cartItem->save();
            } else {
                // Nếu sản phẩm chưa có, thêm mới
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $validated['product_id'],
                    'quantity' => $validated['quantity'],
                    'price' => $price,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng!',
            ]);
        } catch (\Exception $e) {
            // Xử lý lỗi bất ngờ
            return response()->json([
                'status' => false,
                'message' => 'Đã xảy ra lỗi khi thêm vào giỏ hàng.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getData()
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn cần đăng nhập để xem giỏ hàng.',
            ], 401);
        }
        $cartItems = Cart::with('product')
            ->where('user_id', $user->id)
            ->get();

        return response()->json([
            'status' => true,
            'data' => $cartItems,
        ]);
    }

    public function destroyProductCart($id)
    {
        $product = Cart::where('id', $id)->first();
        if($product){
            $product->delete();
            return response()->json([
                'status' => true,
                'message' => 'Xóa sản phẩm khỏi giỏ hàng thành công!'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi xóa sản phẩm giỏ hàng!'
            ]);
        }
    }

    public function updateQuantity(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn cần đăng nhập để thêm vào giỏ hàng.',
            ], 401);
        }
        $product = Cart::where('id', $request->id)->first();
        if($product){
              $product->quantity = $request->quantity;
              $product->save();
              return response()->json([
                'status' => true,
                'message' => 'Cập nhật số lượng thành công'
              ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi cập nhật số lượng!'
              ]);
        }
    }
}
