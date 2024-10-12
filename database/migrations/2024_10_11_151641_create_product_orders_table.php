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
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->unsignedBigInteger('order_id'); // Khóa ngoại order_id
            $table->unsignedBigInteger('product_id'); // Khóa ngoại product_id
            $table->integer('quantity'); // Số lượng
            $table->decimal('price', 10, 2); // Giá
            $table->decimal('total', 10, 2); // Tổng
            $table->timestamps(); // Tự động thêm created_at và updated_at

            // Ràng buộc khóa ngoại
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_orders');
    }
};
