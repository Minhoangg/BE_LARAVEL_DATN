<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'users'
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'payment_methods'
            $table->date('order_date'); // Ngày đặt hàng
            $table->decimal('total', 10, 2); // Tổng số tiền đơn hàng
            $table->string('status')->default('pending'); // Trạng thái đơn hàng
            $table->string('shipping_address'); // Địa chỉ giao hàng
            $table->string('sku_order')->unique(); // Mã SKU đơn hàng
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
        Schema::dropIfExists('orders');
    }
}
