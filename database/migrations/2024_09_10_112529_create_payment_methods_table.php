<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->string('name'); // Tên phương thức thanh toán
            $table->string('method_type'); // Loại phương thức thanh toán
            $table->string('provider')->nullable(); // Nhà cung cấp dịch vụ, nullable trong trường hợp không cần
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
        Schema::dropIfExists('payment_methods');
    }
}
