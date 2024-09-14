<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_statuses', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->foreignId('id_product')->constrained('products')->onDelete('cascade'); // Khóa ngoại tham chiếu đến bảng 'products'
            $table->foreignId('id_status_product')->constrained('status_products')->onDelete('cascade'); // Khóa ngoại tham chiếu đến bảng 'status_products'
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
        Schema::dropIfExists('product_statuses');
    }
}
