<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id(); // Tự động tạo khóa chính 'id'
            $table->foreignId('parent_id')->nullable()->constrained('product_categories')->onDelete('cascade'); // Khóa ngoại tới chính nó
            $table->string('name'); // Tên của danh mục sản phẩm
            $table->string('img_icon')->nullable(); // Icon hình ảnh (có thể null)
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
        Schema::dropIfExists('product_categories');
    }
}
