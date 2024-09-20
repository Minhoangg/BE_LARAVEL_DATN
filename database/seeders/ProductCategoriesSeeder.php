<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Thực hiện thêm dữ liệu vào bảng product_categories.
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            [
                'name' => 'Điện thoại',
                'img_icon' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
