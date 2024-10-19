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
                'total' => 500000,
                'status_id' => 1,
                'paymend_status_id' => 1,
                'sku_order' => Str::random(10),
                'province_code' => 'An Giang',
                'district_code' => 'Huyện Phú Tân',
                'ward_code' => 'Xã Phú Bình',
                'street_address' => 'ấp bình phú 1, phú bình, phú tân, an giang',
                'created_at' => now(),
            ],
            // đã xác nhận có 2 trường hợp đã thanh toán và chưa thanh toán
            [
                'user_id' => 2,
                'total' => 250000,
                'status_id' => 2,
                'paymend_status_id' => 1,
                'sku_order' => Str::random(10),
                'province_code' => 'An Giang',
                'district_code' => 'Huyện Phú Tân',
                'ward_code' => 'Xã Phú Bình',
                'street_address' => 'ấp bình phú 1, phú bình, phú tân, an giang',
                'created_at' => now(),
            ],
            [
                'user_id' => 2,
                'total' => 250000,
                'status_id' => 2,
                'paymend_status_id' => 2,
                'sku_order' => Str::random(10),
                'province_code' => 'An Giang',
                'district_code' => 'Huyện Phú Tân',
                'ward_code' => 'Xã Phú Bình',
                'street_address' => 'ấp bình phú 1, phú bình, phú tân, an giang',
                'created_at' => now(),
            ],
            // đang vận chuyển có 2 trường hợp đã thanh toán và chưa thanh toán
            [
                'user_id' => 2,
                'total' => 250000,
                'status_id' => 3,
                'paymend_status_id' => 1,
                'sku_order' => Str::random(10),
                'province_code' => 'An Giang',
                'district_code' => 'Huyện Phú Tân',
                'ward_code' => 'Xã Phú Bình',
                'street_address' => 'ấp bình phú 1, phú bình, phú tân, an giang',
                'created_at' => now(),
            ],
            [
                'user_id' => 2,
                'total' => 250000,
                'status_id' => 3,
                'paymend_status_id' => 2,
                'sku_order' => Str::random(10),
                'province_code' => 'An Giang',
                'district_code' => 'Huyện Phú Tân',
                'ward_code' => 'Xã Phú Bình',
                'street_address' => 'ấp bình phú 1, phú bình, phú tân, an giang',
                'created_at' => now(),
            ],
            // đã hủy đơn hàng có 2 trường hợp đã thanh toán và chưa thanh toán
            [
                'user_id' => 2,
                'total' => 250000,
                'status_id' => 4,
                'paymend_status_id' => 1,
                'sku_order' => Str::random(10),
                'province_code' => 'An Giang',
                'district_code' => 'Huyện Phú Tân',
                'ward_code' => 'Xã Phú Bình',
                'street_address' => 'ấp bình phú 1, phú bình, phú tân, an giang',
                'created_at' => now(),
            ],
            [
                'user_id' => 2,
                'total' => 250000,
                'status_id' => 4,
                'paymend_status_id' => 2,
                'sku_order' => Str::random(10),
                'province_code' => 'An Giang',
                'district_code' => 'Huyện Phú Tân',
                'ward_code' => 'Xã Phú Bình',
                'street_address' => 'ấp bình phú 1, phú bình, phú tân, an giang',
                'created_at' => now(),
            ],
            // thành công
            [
                'user_id' => 2,
                'total' => 250000,
                'status_id' => 5,
                'paymend_status_id' => 1,
                'sku_order' => Str::random(10),
                'province_code' => 'An Giang',
                'district_code' => 'Huyện Phú Tân',
                'ward_code' => 'Xã Phú Bình',
                'street_address' => 'ấp bình phú 1, phú bình, phú tân, an giang',
                'created_at' => now(),
            ],
        ]);
    }
}
