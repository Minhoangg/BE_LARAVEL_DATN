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
        Schema::table('product_categories', function (Blueprint $table) {
            // Xóa khóa ngoại trước khi xóa cột
            $table->dropForeign(['parent_id']); // Xóa khóa ngoại
            $table->dropColumn('parent_id'); // Xóa cột 'parent_id'
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable(); // Thêm lại cột 'parent_id'
            $table->foreign('parent_id')->references('id')->on('product_categories')->onDelete('cascade'); // Thêm lại khóa ngoại
        });
    }
};
