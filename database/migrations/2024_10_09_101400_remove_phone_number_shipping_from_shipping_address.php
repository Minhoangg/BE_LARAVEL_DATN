<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shipping_address', function (Blueprint $table) {
            // Thêm cột user_id, chỉ định rõ bảng 'users'
            $table->foreignId('user_id')->constrained('users')->after('id');

            // Thêm các cột city_code, district_code, ward_code (không cần chỉ định độ dài cho integer)
            $table->integer('city_code')->after('user_id');
            $table->integer('district_code')->after('city_code');
            $table->integer('ward_code')->after('district_code');

            // Xóa các cột không cần thiết
            $table->dropColumn(['phone_number_shipping', 'status']);
        });
    }

    public function down(): void
    {
        Schema::table('shipping_address', function (Blueprint $table) {
            // Xóa khóa ngoại và cột user_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // Xóa các cột ward_code, district_code, city_code
            $table->dropColumn(['ward_code', 'district_code', 'city_code']);

            // Khôi phục lại các cột đã xóa trước đó
            $table->string('phone_number_shipping', 15)->after('id');
            $table->boolean('status')->default(true)->after('phone_number_shipping');
        });
    }
};
