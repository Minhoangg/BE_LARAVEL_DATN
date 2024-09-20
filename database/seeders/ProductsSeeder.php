<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Thực hiện thêm dữ liệu vào bảng products.
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'parent_id' => 1, // ID của parent product
                'name' => 'Iphone 16 promax 526GB',
                'price' => 17000000,
                'price_sale' => 15500000,
                'quantity' => 60,
                'avatar' => null, // Giá trị có thể là null
                'private_desc' => '- Ram 12GB\r\n- Bộ nhớ trong 526GB\r\n',
                'tag_sale' => 'iphone, iphone 16, iphone xịn',
                'created_at' => '2024-09-17 10:50:05',
                'updated_at' => '2024-09-17 10:50:05',
            ],
            [
                'parent_id' => 1, // ID của parent product
                'name' => 'Iphone 16 promax 256GB',
                'price' => 16000000,
                'price_sale' => 14500000,
                'quantity' => 60,
                'avatar' => null, // Giá trị có thể là null
                'private_desc' => '- Ram 12GB\r\n- Bộ nhớ trong 256GB\r\n',
                'tag_sale' => 'iphone, iphone 16, iphone xịn',
                'created_at' => '2024-09-17 10:50:05',
                'updated_at' => '2024-09-17 10:50:05',
            ]
        ]);
    }
}
