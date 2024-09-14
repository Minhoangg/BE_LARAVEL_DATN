<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewsImgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews_img', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->foreignId('id_product_reviews')->constrained('product_reviews')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'product_reviews'
            $table->string('img_path'); // Đường dẫn tới hình ảnh
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
        Schema::dropIfExists('product_reviews_img');
    }
}
