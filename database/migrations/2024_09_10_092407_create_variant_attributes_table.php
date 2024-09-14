<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variant_attributes', function (Blueprint $table) {
            $table->id(); // Khóa chính 'id'
            $table->string('name'); // Tên thuộc tính biến thể (ví dụ: Đỏ, L)
            $table->string('color_code')->nullable(); // Mã màu (có thể null nếu không phải màu sắc)
            $table->foreignId('id_variant')->constrained('variants')->onDelete('cascade'); // Khóa ngoại tham chiếu đến bảng 'variants'
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
        Schema::dropIfExists('variant_attributes');
    }
}
