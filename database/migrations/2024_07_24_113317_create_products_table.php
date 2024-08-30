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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categories_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->decimal('price_sale', 10, 2)->nullable();
            $table->text('desc')->nullable();
            $table->text('short_desc')->nullable();
            $table->integer('quantity');
            $table->string('avatar')->nullable();
            $table->text('private_desc')->nullable();
            $table->string('tag')->nullable();
            $table->timestamps();

            // Đặt khóa ngoại cho categories_id và parent_id
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('parent_products')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
