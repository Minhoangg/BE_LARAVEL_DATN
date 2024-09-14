<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->foreignId('parent_id')->constrained('parent_products')->onDelete('cascade'); // Khóa ngoại tham chiếu đến bảng 'parent_products'
            $table->string('name'); // Tên sản phẩm
            $table->decimal('price', 10, 2); // Giá sản phẩm
            $table->decimal('price_sale', 10, 2)->nullable(); // Giá khuyến mãi (có thể null)
            $table->integer('quantity'); // Số lượng sản phẩm trong kho
            $table->string('avatar')->nullable(); // Đường dẫn ảnh đại diện của sản phẩm (có thể null)
            $table->text('private_desc')->nullable(); // Mô tả riêng tư (có thể null)
            $table->string('tag_sale')->nullable(); // Thẻ khuyến mãi (có thể null)
            $table->timestamps(); // Tự động thêm các cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
