<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shipping_address', function (Blueprint $table) {
            // Thêm cột user_id
            $table->foreignId('user_id')->constrained()->after('id'); // Hoặc không có `->constrained()` nếu bạn muốn tạo khóa ngoại sau

            // Xóa cột không cần thiết
            $table->dropColumn('phone_number_shipping');
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipping_address', function (Blueprint $table) {
            // Xóa cột user_id
            $table->dropForeign(['user_id']); // Xóa khóa ngoại
            $table->dropColumn('user_id'); // Xóa cột user_id

            // Khôi phục lại các cột đã xóa
            $table->string('phone_number_shipping', 15)->after('id');
            $table->boolean('status')->default(true);
        });
    }
};
