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
        Schema::table('admin_accounts', function (Blueprint $table) {
            $table->string('password');
            $table->string('otpCode')->nullable(); // Thêm cột otpCode
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_accounts', function (Blueprint $table) {
            $table->dropColumn(['password', 'otpCode']); // Xóa các cột khi rollback migration
        });
    }
};
