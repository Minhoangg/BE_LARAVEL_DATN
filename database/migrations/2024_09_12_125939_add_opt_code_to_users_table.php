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
    Schema::table('users', function (Blueprint $table) {
        $table->string('optCode')->nullable()->after('email'); // Bạn có thể chọn vị trí đặt cột bằng `after`
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('optCode');
    });
}
};
