<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPaymendSeeder extends Seeder
{
    public function run()
    {
        DB::table('paymend_status')->insert([
            [
                'name' => 'Chưa Thanh Toán'
            ],
            [
                'name' => 'Đã Thanh Toán'
            ],
            [
                'name' => 'Thanh Toán Thiếu'
            ],
            [
                'name' => 'Thanh Toán Dư'
            ],
        ]);
    }
}
