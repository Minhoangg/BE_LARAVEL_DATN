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
        Schema::create('product_categories_variant', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_product_categories'); // Khóa ngoại tới bảng product_categories
            $table->unsignedBigInteger('id_variant'); // Khóa ngoại tới bảng variants
            $table->timestamps();

            // Thêm khóa ngoại
            $table->foreign('id_product_categories')->references('id')->on('product_categories')->onDelete('cascade');
            $table->foreign('id_variant')->references('id')->on('variants')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_categories_variant');
    }
};
