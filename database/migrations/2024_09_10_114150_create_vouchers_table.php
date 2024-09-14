<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->foreignId('id_product')->nullable()->constrained('products')->onDelete('cascade'); // Khóa ngoại tùy chọn liên kết với bảng 'products'
            $table->string('code')->unique(); // Mã giảm giá duy nhất
            $table->decimal('discount_percentage', 5, 2); // Phần trăm giảm giá
            $table->date('start_date'); // Ngày bắt đầu
            $table->date('end_date'); // Ngày kết thúc
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
        Schema::dropIfExists('vouchers');
    }
}
