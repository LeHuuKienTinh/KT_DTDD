<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getData()
    {
        $data = Product::select('id','name','slug' ,'price', 'img', 'rating', 'reviews', 'id_cate', 'description')->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function getDataDetail($id)
    {
        $data = Product::where('id',$id)->select('id','name','slug' ,'price', 'img', 'rating','description', 'reviews', 'id_cate')->first();
        return response()->json([
            'data' => $data
        ]);
    }

    public function searchProduct(Request $request)
    {
        $query = $request->input('query'); //lấy từ tìm kiếm ở ô người dùng nhập vào
        $product = Product::where('name','like','%' . $query . '%')->get();
        return response()->json([
            'data'=> $product
        ]);
    }

    public function destroyProduct($id)
    {
        $product = Product::where('id', $id)->first();
        if($product){
            $product->delete();
            return response()->json([
                'status' => true,
                'message' => 'Xóa sản phẩm'.  $product->name .'thành công'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Sản phẩm không tồn tại hoặc bị lỗi'
            ]);
        }
    }

    public function updateProduct(Request $request)
    {
        $product = Product::where('id', $request->id)-> first();
        if($product){
            $product->update([
                'name' => $request->name,
                'price' =>$request->price,
                'id_cate' =>$request->id_cate,
                'img' => $request->img,
                'description' => $request->description
            ]);
            $product->save();
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật sản phẩm thành công'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi cập nhật sản phẩm'
            ]);
        }
    }

    public function createProduct(Request $request)
    {
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'id_cate' => $request->id_cate,
            'img' =>$request->img,
            'description' => $request->description
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Tạo mới sản phẩm thành công!'
        ]);
    }
}
