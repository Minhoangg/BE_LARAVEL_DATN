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
            $table->integer('total');
            $table->foreignId('status_id')->constrained('status_order')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'status_orders'
            $table->foreignId('paymend_status_id')->nullable()->constrained('paymend_status')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'status_orders'
            $table->string('sku_order'); // Trường sku_order
            $table->string('province_code'); // Trường province_code
            $table->string('district_code'); // Trường district_code
            $table->string('ward_code'); // Trường ward_code
            $table->string('street_address'); // Trường street_address
            $table->dateTime('payment_at')->nullable(); // Trường ngày thanh toán
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
