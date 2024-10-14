<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paymend_status', function (Blueprint $table) {
            $table->id(); // Tạo khóa chính id
            $table->string('name'); // Trường name để lưu trạng thái đơn hàng
            $table->timestamps(); // Tạo các trường created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paymend_status');
    }
};
