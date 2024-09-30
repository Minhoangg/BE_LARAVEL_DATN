<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantsSeeder extends Seeder
{
    public function run()
    {
        // Các thuộc tính của danh mục điện thoại
        DB::table('variants')->insert([
            [
                'name' => 'Màn hình'
            ],
            [
                'name' => 'Màu sắc'
            ],
            [
                'name' => 'Bộ nhớ trong'
            ],
            [
                'name' => 'Bộ nhớ ngoài'
            ],
            [
                'name' => 'Cổng kết nối/sạc'
            ],
            [
                'name' => 'Độ phân giải'
            ],
            [
                'name' => 'Kích cỡ màn hình'
            ],
            [
                'name' => 'Tần số quét'
            ],
            [
                'name' => 'Thiết kế card'
            ],
            [
                'name' => 'Ổ cứng'
            ],
        ]);
    }
}
