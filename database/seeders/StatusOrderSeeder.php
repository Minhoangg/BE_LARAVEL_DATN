<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusOrderSeeder extends Seeder
{
    public function run()
    {
        DB::table('status_order')->insert([
            [
                'name' => 'Chờ xác nhận'
            ],
            [
                'name' => 'Đã xác nhận'
            ],
            [
                'name' => 'Đang vận chuyển'
            ],
            [
                'name' => 'Đã hủy'
            ],
            [
                'name' => 'Thành công'
            ],
        ]);
    }
}
