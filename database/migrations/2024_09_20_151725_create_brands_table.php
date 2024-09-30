<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Tên thương hiệu
            $table->string('desc')->nullable(); // Mô tả về thương hiệu (có thể để trống)
            $table->string('img')->nullable(); // Đường dẫn hình ảnh (có thể để trống)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
