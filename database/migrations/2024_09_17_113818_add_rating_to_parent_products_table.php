<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRatingToParentProductsTable extends Migration
{
    /**
     * Chạy migration để thêm trường.
     */
    public function up()
    {
        Schema::table('parent_products', function (Blueprint $table) {
            $table->integer('rating')->nullable()->after('avatar'); // Sử dụng kiểu integer cho rating
        });
    }

    /**
     * Đảo ngược migration (rollback).
     */
    public function down()
    {
        Schema::table('parent_products', function (Blueprint $table) {
            $table->dropColumn('rating');
        });
    }
}
