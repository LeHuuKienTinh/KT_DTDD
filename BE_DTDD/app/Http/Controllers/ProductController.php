<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getData()
    {
        $data = Product::select('id','name', 'price', 'img', 'rating', 'reviews', 'id_cate')->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function getDataDetail($id)
    {
        $data = Product::where('id',$id)->select('id','name', 'price', 'img', 'rating', 'reviews', 'id_cate')->first();
        return response()->json([
            'data' => $data
        ]);
    }
}
