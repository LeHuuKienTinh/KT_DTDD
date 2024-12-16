<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',       // ID người dùng
        'product_id',    // ID sản phẩm
        'quantity',      // Số lượng sản phẩm
        'price',         // Giá sản phẩm
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Định nghĩa quan hệ với sản phẩm.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
