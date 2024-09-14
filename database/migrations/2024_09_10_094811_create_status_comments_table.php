<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_comments', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->string('name'); // Tên trạng thái bình luận (ví dụ: Đã duyệt, Chưa duyệt, Bị từ chối)
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
        Schema::dropIfExists('status_comments');
    }
}
