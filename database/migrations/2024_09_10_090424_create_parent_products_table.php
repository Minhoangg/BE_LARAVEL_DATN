<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_products', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->foreignId('categories_id')->constrained('product_categories')->onDelete('cascade'); // Khóa ngoại tham chiếu tới bảng 'product_categories'
            $table->string('name'); // Tên của sản phẩm
            $table->text('desc')->nullable(); // Mô tả chi tiết sản phẩm (có thể null)
            $table->string('short_desc')->nullable(); // Mô tả ngắn gọn (có thể null)
            $table->string('avatar')->nullable(); // Đường dẫn ảnh đại diện của sản phẩm (có thể null)
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
        Schema::dropIfExists('parent_products');
    }
}
