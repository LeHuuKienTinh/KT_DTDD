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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique(); // Mã đơn hàng
            $table->decimal('amount', 10, 2); // Tổng số tiền
            $table->string('status')->default('pending'); // Trạng thái: pending, paid, failed
            $table->string('qr_code')->nullable(); // Nội dung QR Code
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
