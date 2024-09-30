<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategoriesVariant;
use Illuminate\Support\Facades\DB;


class ProductCategoriesVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo các dữ liệu điện thoại
        DB::table('product_categories_variant')->insert([
            [
                'id_product_categories' => 1,
                'id_variant' => 1,
            ],
            [
                'id_product_categories' => 1,
                'id_variant' => 2,
            ],
            [
                'id_product_categories' => 1,
                'id_variant' => 3,
            ],
            [
                'id_product_categories' => 1,
                'id_variant' => 4,
            ],
            [
                'id_product_categories' => 1,
                'id_variant' => 5,
            ],
            [
                'id_product_categories' => 1,
                'id_variant' => 6,
            ],
            [
                'id_product_categories' => 1,
                'id_variant' => 7,
            ],
            [
                'id_product_categories' => 1,
                'id_variant' => 8,
            ]
        ]);

        // Tạo các dữ liệu tablet
        DB::table('product_categories_variant')->insert([
            [
                'id_product_categories' => 2,
                'id_variant' => 1,
            ],
            [
                'id_product_categories' => 2,
                'id_variant' => 6,
            ],
            [
                'id_product_categories' => 2,
                'id_variant' => 7,
            ],
        ]);

        // Tạo các dữ liệu laptop
        DB::table('product_categories_variant')->insert([
            [
                'id_product_categories' => 3,
                'id_variant' => 7,
            ],
            [
                'id_product_categories' => 3,
                'id_variant' => 3,
            ],
            [
                'id_product_categories' => 3,
                'id_variant' => 4,
            ],
            [
                'id_product_categories' => 3,
                'id_variant' => 6,
            ],
            [
                'id_product_categories' => 3,
                'id_variant' => 9,
            ],
            [
                'id_product_categories' => 3,
                'id_variant' => 10,
            ],
            [
                'id_product_categories' => 3,
                'id_variant' => 8,
            ],
        ]);
    }
}
