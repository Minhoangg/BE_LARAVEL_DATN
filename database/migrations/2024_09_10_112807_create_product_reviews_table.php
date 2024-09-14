<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'products'
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'users'
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'orders'
            $table->text('content'); // Nội dung đánh giá
            $table->integer('rating')->check(function ($rating) {
                return $rating >= 1 && $rating <= 5;
            }); // Điểm số đánh giá, giới hạn từ 1 đến 5 sao
            $table->timestamps(); // Tự động thêm cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_reviews');
    }
}
