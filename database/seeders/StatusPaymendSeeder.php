<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPaymendSeeder extends Seeder
{
    public function run()
    {
        // Các thuộc tính của danh mục điện thoại
        DB::table('paymend_status')->insert([
            [
                'name' => 'Đã Thanh Toán'
            ],
            [
                'name' => 'Chưa Thanh Toán'
            ],
        ]);
    }
}
