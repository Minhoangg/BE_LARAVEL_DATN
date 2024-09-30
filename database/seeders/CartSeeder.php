<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\CartModel;


class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create() ;

        for ($i = 1; $i <= 10; $i++) {
            DB::table('carts')->insert([
                'id' => $i,
                'user_id' => $faker->numberBetween(1, 10), // Giả định có 10 người dùng
                'product_id' =>1, // Giả định có 50 sản phẩm
                'quantity' => $faker->numberBetween(1, 5), // Số lượng từ 1 đến 5
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
