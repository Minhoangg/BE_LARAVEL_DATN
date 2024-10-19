<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_details')->insert([
            // chờ xác nhận
            [
                'order_id' => 1,
                'product_id' => 1,
                'quantity' => 2,
                'price' => 50000,
                'total' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // đã xác nhận
            [
                'order_id' => 2,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 75000,
                'total' => 75000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // đang vận chuyển
            [
                'order_id' => 4,
                'product_id' => 1,
                'quantity' => 3,
                'price' => 20000,
                'total' => 60000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // đã hủy
            [
                'order_id' => 6,
                'product_id' => 1,
                'quantity' => 3,
                'price' => 20000,
                'total' => 60000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // thành công
            [
                'order_id' => 7,
                'product_id' => 1,
                'quantity' => 3,
                'price' => 20000,
                'total' => 60000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
