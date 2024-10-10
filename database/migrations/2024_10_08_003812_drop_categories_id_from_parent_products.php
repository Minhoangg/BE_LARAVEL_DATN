<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('parent_products', function (Blueprint $table) {
            // Xóa khóa ngoại trước khi xóa cột
            $table->dropForeign(['categories_id']); // Xóa khóa ngoại
            $table->dropColumn('categories_id'); // Xóa cột 'categories_id'
        });
    }

    public function down()
    {
        Schema::table('parent_products', function (Blueprint $table) {
            // Thêm lại cột 'categories_id' nếu rollback
            $table->unsignedBigInteger('categories_id')->nullable();

            // Thêm lại khóa ngoại nếu rollback
            $table->foreign('categories_id')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }
};
