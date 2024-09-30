<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsSeeder extends Seeder
{
    public function run()
    {
        // brand điện thoại
        DB::table('brands')->insert([
            [
                'name' => 'Iphone',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 1,
                'img' => 'path/to/apple-logo.png',
            ],
            [
                'name' => 'GALAXY Tab',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 1,
                'img' => 'path/to/apple-logo.png',
            ],
            [
                'name' => 'Nokia',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 1,
                'img' => 'path/to/apple-logo.png',
            ],
            [
                'name' => 'OPPO',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 1,
                'img' => 'path/to/apple-logo.png',
            ],
            [
                'name' => 'realme',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 1,
                'img' => 'path/to/apple-logo.png',
            ],
            [
                'name' => 'xiaomi',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 1,
                'img' => 'path/to/apple-logo.png',
            ]
        ]);

        // brand tablet
        DB::table('brands')->insert([
            [
                'name' => 'IPad',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 2,
                'img' => 'path/to/apple-logo.png',
            ],
            [
                'name' => 'Masstel',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 2,
                'img' => 'path/to/apple-logo.png',
            ],
            [
                'name' => 'SAMSUNG',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 2,
                'img' => 'path/to/apple-logo.png',
            ],

        ]);

        // brand labtop
        DB::table('brands')->insert([
            [
                'name' => 'Macbook',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 3,
                'img' => 'path/to/apple-logo.png',
            ],
            [
                'name' => 'ACER',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 3,
                'img' => 'path/to/apple-logo.png',
            ],
            [
                'name' => 'ASUS',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 3,
                'img' => 'path/to/apple-logo.png',
            ],
            [
                'name' => 'DELL',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 3,
                'img' => 'path/to/apple-logo.png',
            ],
            [
                'name' => 'HP',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 3,
                'img' => 'path/to/apple-logo.png',
            ],
            [
                'name' => 'LENOVO',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 3,
                'img' => 'path/to/apple-logo.png',
            ],
            [
                'name' => 'MSI',
                'desc' => 'Thương hiệu điện thoại n��i tiếng với sản phẩm điện tử như iPhone, MacBook.',
                'id_product_categories' => 3,
                'img' => 'path/to/apple-logo.png',
            ]
        ]);
    }
}
