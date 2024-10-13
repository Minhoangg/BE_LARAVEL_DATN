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
        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('id_variant')->nullable();

            // Thiết lập khóa ngoại
            $table->foreign('id_variant')
                ->references('id')
                ->on('product_variants')
                ->onDelete('cascade');

            // Thêm ràng buộc duy nhất giữa user_id, product_id và id_variant
            $table->unique([ 'id_variant']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            //
        });
    }
};
