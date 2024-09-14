<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại tham chiếu đến bảng 'products'
            $table->string('image_url'); // URL của ảnh
            $table->string('alt_text')->nullable(); // Văn bản thay thế cho hình ảnh (có thể null)
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
        Schema::dropIfExists('product_images');
    }
}
