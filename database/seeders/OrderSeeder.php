<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'user_id' => 1,
                'total' => 500000, // Giá trị đơn hàng
                'status_id' => 1, // Trạng thái đơn hàng
                'sku_order' => Str::random(10), // Tạo SKU ngẫu nhiên
                'province_code' => 'An Giang', // Mã tỉnh
                'district_code' => 'Huyện Phú Tân', // Mã quận/huyện
                'ward_code' => 'Xã Phú Bình', // Mã phường/xã
                'street_address' => 'ấp bình phú 1, phú bình, phú tân, an giang', // Địa chỉ chi tiết
                'created_at' => now(), // Ngày tạo
            ],
            [
                'user_id' => 2,
                'total' => 250000, 
                'status_id' => 1,
                'sku_order' => Str::random(10), 
                'province_code' => 'An Giang', // Mã tỉnh
                'district_code' => 'Huyện Phú Tân', // Mã quận/huyện
                'ward_code' => 'Xã Phú Bình', // Mã phường/xã
                'street_address' => 'ấp bình phú 1, phú bình, phú tân, an giang', // Địa chỉ chi tiết
                'created_at' => now(),
            ],
            // Thêm nhiều dữ liệu khác nếu cần
        ]);
    }
}
