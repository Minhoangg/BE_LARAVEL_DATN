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
        Schema::table('parent_products', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->nullable(); // Thêm cột 'rice'
            $table->decimal('price_sale', 8, 2)->nullable(); // Thêm cột 'rice_sale'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('parent_products', function (Blueprint $table) {
            $table->dropColumn(['price', 'price_sale']);
        });
    }
};
