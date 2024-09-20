<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentProductsSeeder extends Seeder
{
    /**
     * Thực hiện thêm dữ liệu vào bảng parent_products.
     */
    public function run()
    {
        DB::table('parent_products')->insert([
            [
                'categories_id' => 1, // Có thể là giá trị null
                'name' => 'Iphone 16 promax',
                'desc' => 'Đây là chiếc điện thoại mới nhất của hãng Apple cho ra mắt vào thị trường tháng 9/2024.',
                'short_desc' => '- Hiệu năng mạnh mẽ\r\n- Dung lượng pin khủng\r\n- Camera được update cực nét\r\n- Màn hình full HD sắc nét',
                'avatar' => null, // Giá trị có thể là null
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm nhiều sản phẩm khác nếu muốn
        ]);
    }
}
