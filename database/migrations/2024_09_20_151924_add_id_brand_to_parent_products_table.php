<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdBrandToParentProductsTable extends Migration
{
    public function up()
    {
        Schema::table('parent_products', function (Blueprint $table) {
            $table->unsignedBigInteger('id_brand')->nullable()->after('name'); // Thêm cột id_brand
            $table->foreign('id_brand')->references('id')->on('brands')->onDelete('set null'); // Thiết lập khóa ngoại với bảng brands
        });
    }

    public function down()
    {
        Schema::table('parent_products', function (Blueprint $table) {
            $table->dropForeign(['id_brand']); // Xóa khóa ngoại
            $table->dropColumn('id_brand'); // Xóa cột id_brand
        });
    }
}
