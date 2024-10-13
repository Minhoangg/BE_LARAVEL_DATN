<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusOrderSeeder extends Seeder
{
    public function run()
    {
        // Các thuộc tính của danh mục điện thoại
        DB::table('status_order')->insert([
            [
                'name' => 'Đã Duyệt'
            ],
            [
                'name' => 'Chưa Duyệt'
            ],
        ]);
    }
}
