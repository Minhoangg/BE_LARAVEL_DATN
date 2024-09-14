<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->foreignId('id_product')->constrained('products')->onDelete('cascade'); // Khóa ngoại tham chiếu đến bảng 'products'
            $table->foreignId('id_variant_attribute')->constrained('variant_attributes')->onDelete('cascade'); // Khóa ngoại tham chiếu đến bảng 'variant_attributes'
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
        Schema::dropIfExists('product_variants');
    }
}
