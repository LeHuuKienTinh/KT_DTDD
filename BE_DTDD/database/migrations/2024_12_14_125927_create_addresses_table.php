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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Liên kết với bảng users
            $table->string('phone'); // Số điện thoại
            $table->string('name'); // Tên người nhận
            $table->text('address'); // Địa chỉ cụ thể
            $table->string('city'); // Thành phố
            $table->string('district'); // Quận/Huyện
            $table->boolean('is_default')->default(0); // Địa chỉ mặc định
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
