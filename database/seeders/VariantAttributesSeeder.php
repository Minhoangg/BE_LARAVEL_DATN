<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantAttributesSeeder extends Seeder
{
    public function run()
    {
        // Thêm giá trị Màn hình
        DB::table('variant_attributes')->insert([
            [
                'name' => 'SUPER AMOLED',
                'color_code' => null,
                'id_variant' => 1,
            ],
            [
                'name' => 'Ultra Retina XDR',
                'color_code' => null,
                'id_variant' => 1,
            ],
            [
                'name' => 'IPS LCD',
                'color_code' => null,
                'id_variant' => 1,
            ],
            [
                'name' => 'Retina IPS LCD',
                'color_code' => null,
                'id_variant' => 1,
            ],
            [
                'name' => 'PLS LCD',
                'color_code' => null,
                'id_variant' => 1,
            ],
            [
                'name' => 'Super AMOLED Plus',
                'color_code' => null,
                'id_variant' => 1,
            ],
            [
                'name' => 'Dynamic AMOLED 2X',
                'color_code' => null,
                'id_variant' => 1,
            ],
            [
                'name' => 'Chính: Dynamic AMOLED 2X, Phụ: Super AMOLED',
                'color_code' => null,
                'id_variant' => 1,
            ],
            [
                'name' => 'OLED',
                'color_code' => null,
                'id_variant' => 1,
            ],
        ]);

        // Thêm giá trị cho màu sắc
        DB::table('variant_attributes')->insert([
            [
                'name' => 'Trắng',
                'color_code' => '#FFFFFF',
                'id_variant' => 2,
            ],
            [
                'name' => 'Đen',
                'color_code' => '#000000',
                'id_variant' => 2,
            ],
            [
                'name' => 'Xanh lá cây',
                'color_code' => '#009688',
                'id_variant' => 2,
            ],
            [
                'name' => 'Xanh dương',
                'color_code' => '#0000FF',
                'id_variant' => 2,
            ],
            [
                'name' => 'Vàng',
                'color_code' => '#FFFF00',
                'id_variant' => 2,
            ],
        ]);

        // Thêm giá trị cho Bộ nhớ trong
        DB::table('variant_attributes')->insert([
            [
                'name' => '64GB',
                'color_code' => null,
                'id_variant' => 3,
            ],
            [
                'name' => '128GB',
                'color_code' => null,
                'id_variant' => 3,
            ],
            [
                'name' => '256GB',
                'color_code' => null,
                'id_variant' => 3,
            ],
            [
                'name' => '512GB',
                'color_code' => null,
                'id_variant' => 3,
            ],
            [
                'name' => '1TB',
                'color_code' => null,
                'id_variant' => 3,
            ],
            [
                'name' => '2TB',
                'color_code' => null,
                'id_variant' => 3,
            ],
        ]);


        // Thêm giá trị Bộ nhớ ngoài (RAM)
        DB::table('variant_attributes')->insert([
            [
                'name' => '2GB',
                'color_code' => null,
                'id_variant' => 4,
            ],
            [
                'name' => '4GB',
                'color_code' => null,
                'id_variant' => 4,
            ],
            [
                'name' => '6GB',
                'color_code' => null,
                'id_variant' => 4,
            ],
            [
                'name' => '8GB',
                'color_code' => null,
                'id_variant' => 4,
            ],
            [
                'name' => '12GB',
                'color_code' => null,
                'id_variant' => 4,
            ],
            [
                'name' => '16GB',
                'color_code' => null,
                'id_variant' => 4,
            ],
            [
                'name' => '32GB',
                'color_code' => null,
                'id_variant' => 4,
            ],
            [
                'name' => '64GB',
                'color_code' => null,
                'id_variant' => 4,
            ],
        ]);

        // Thêm giá trị cho cổng kết nối/sạc
        DB::table('variant_attributes')->insert([
            [
                'name' => 'USB Type-C',
                'color_code' => null,
                'id_variant' => 5,
            ],
            [
                'name' => 'Type-A',
                'color_code' => null,
                'id_variant' => 5,
            ],
            [
                'name' => 'Type-C/Type-A',
                'color_code' => null,
                'id_variant' => 5,
            ],
            [
                'name' => 'Lightning',
                'color_code' => null,
                'id_variant' => 5,
            ],
            [
                'name' => 'Micro USB',
                'color_code' => null,
                'id_variant' => 5,
            ],
            [
                'name' => 'Mini USB',
                'color_code' => null,
                'id_variant' => 5,
            ],
        ]);

        // Thêm giá trị thuộc tính độ phân giải
        DB::table('variant_attributes')->insert([
            [
                'name' => '1080p',
                'color_code' => null,
                'id_variant' => 6,
            ],
            [
                'name' => '1440p',
                'color_code' => null,
                'id_variant' => 6,
            ],
            [
                'name' => '4K UHD',
                'color_code' => null,
                'id_variant' => 6,
            ],
            [
                'name' => 'HDR',
                'color_code' => null,
                'id_variant' => 6,
            ],
        ]);

        // Thêm giá trị kích cỡ màn hình
        DB::table('variant_attributes')->insert([
            [
                'name' => '6.3 inch',
                'color_code' => null,
                'id_variant' => 7,
            ],
            [
                'name' => '6.5 inch',
                'color_code' => null,
                'id_variant' => 7,
            ],
            [
                'name' => '6.7 inch',
                'color_code' => null,
                'id_variant' => 7,
            ],
            [
                'name' => '6.9 inch',
                'color_code' => null,
                'id_variant' => 7,
            ],
            [
                'name' => '11 inch',
                'color_code' => null,
                'id_variant' => 7,
            ],
            [
                'name' => '20 inch',
                'color_code' => null,
                'id_variant' => 7,
            ],
            [
                'name' => '17 inch',
                'color_code' => null,
                'id_variant' => 7,
            ],
        ]);

        // Thêm giá trị cho tần số quét
        DB::table('variant_attributes')->insert([
            [
                'name' => '60 Hz',
                'color_code' => null,
                'id_variant' => 8,
            ],
            [
                'name' => '100 Hz',
                'color_code' => null,
                'id_variant' => 8,
            ],
            [
                'name' => '120 Hz',
                'color_code' => null,
                'id_variant' => 8,
            ],
            [
                'name' => '144 Hz',
                'color_code' => null,
                'id_variant' => 8,
            ],
        ]);

        // Thêm giá trị cho thiết kế card laptop
        DB::table('variant_attributes')->insert([
            [
                'name' => 'Card rời',
                'color_code' => null,
                'id_variant' => 9,
            ],
            [
                'name' => 'Card tích hợp',
                'color_code' => null,
                'id_variant' => 9,
            ],
        ]);

        // thêm giá trị cho ổ cứng
        DB::table('variant_attributes')->insert([
            [
                'name' => 'Ổ cứng SSD 512GB',
                'color_code' => null,
                'id_variant' => 10,
            ],
            [
                'name' => 'Ổ cứng SSD 1TB',
                'color_code' => null,
                'id_variant' => 10,
            ],
            [
                'name' => 'Ổ cứng SSD 2TB',
                'color_code' => null,
                'id_variant' => 10,
            ],
            [
                'name' => 'Ổ cứng SSD 4TB',
                'color_code' => null,
                'id_variant' => 10,
            ],
        ]);
    }
}
