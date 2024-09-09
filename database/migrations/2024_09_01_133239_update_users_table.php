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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number', 15)->after('email')->nullable()->unique();
            $table->string('gender', 255)->after('phone_number')->nullable();
            $table->date('date_of_birth')->after('gender')->nullable();
            $table->unsignedBigInteger('shipping_address_id')->after('date_of_birth')->nullable();
            $table->float('point')->after('shipping_address_id')->nullable();

            $table->string('email')->nullable()->change();

            $table->foreign('shipping_address_id')->references('id')->on('shipping_address')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['shipping_address_id']);

            $table->dropColumn('phone_number');
            $table->dropColumn('gender');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('shipping_address_id');
            $table->dropColumn('point');

            $table->string('email')->nullable(false)->change();
        });
    }
};
