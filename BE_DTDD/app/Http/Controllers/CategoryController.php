<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getData()
    {
        $data = Category::select('id','name_cate', 'slug_cate')->get();
        return response()->json([
            'data' => $data->toArray()
        ]);
    }
}
