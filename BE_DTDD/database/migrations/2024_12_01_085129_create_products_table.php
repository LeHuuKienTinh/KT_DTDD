<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();  // Khóa chính tự động tăng
            $table->string('name');  // Tên sản phẩm
            $table->decimal('price', 10, 2);  // Giá sản phẩm, định dạng 10 chữ số, 2 chữ số thập phân
            $table->string('img')->nullable();  // Hình ảnh sản phẩm (nullable nếu không có ảnh)
            $table->decimal('rating', 2, 1)->nullable();  // Đánh giá, kiểu decimal cho số thập phân, 2 chữ số, 1 chữ số thập phân
            $table->integer('reviews')->default(0);  // Số lượng đánh giá, mặc định là 0
            $table->unsignedBigInteger('id_cate');  // Khóa ngoại đến bảng categories
            $table->foreign('id_cate')->references('id')->on('categories')->onDelete('cascade');  // Thiết lập quan hệ khóa ngoại
            $table->timestamps();  // Các trường created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
