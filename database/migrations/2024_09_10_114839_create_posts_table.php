<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->string('title'); // Tiêu đề bài viết
            $table->string('tag')->nullable(); // Thẻ bài viết, có thể để trống
            $table->text('content'); // Nội dung bài viết
            $table->string('author'); // Tác giả bài viết
            $table->foreignId('id_admin_account')->constrained('admin_accounts')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'admin_accounts'
            $table->foreignId('categories_id')->constrained('post_categories')->onDelete('cascade'); // Khóa ngoại liên kết với bảng 'post_categories'
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
        Schema::dropIfExists('posts');
    }
}
