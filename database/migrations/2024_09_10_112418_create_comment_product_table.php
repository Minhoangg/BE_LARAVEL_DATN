<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_product', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'products'
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'users'
            $table->text('content'); // Nội dung bình luận
            $table->foreignId('id_status_comment')->constrained('status_comments')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'status_comments'
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
        Schema::dropIfExists('comment_product');
    }
}
