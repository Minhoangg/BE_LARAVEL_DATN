<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'orders'
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'products'
            $table->integer('quantity'); // Số lượng sản phẩm trong đơn hàng
            $table->bigInteger('price'); // Giá của sản phẩm tại thời điểm mua
            $table->bigInteger('total'); // Tổng giá trị sản phẩm trong đơn hàng (quantity * price)
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
        Schema::dropIfExists('order_details');
    }
}
