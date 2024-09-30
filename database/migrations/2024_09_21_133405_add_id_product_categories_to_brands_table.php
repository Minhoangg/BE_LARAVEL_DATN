<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdProductCategoriesToBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->unsignedBigInteger('id_product_categories')->nullable(); // Thêm cột khóa ngoại
            $table->foreign('id_product_categories')->references('id')->on('product_categories')->onDelete('cascade'); // Thêm khóa ngoại
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropForeign(['id_product_categories']); // Xóa khóa ngoại
            $table->dropColumn('id_product_categories'); // Xóa cột
        });
    }
}
