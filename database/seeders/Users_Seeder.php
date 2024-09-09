<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Users_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo dữ liệu mẫu cho bảng users
        DB::table('users')->insert([
            [
                'name' => 'Lương Minh Hoàng',
                'email' => 'hoanglm.dev@gmail.com',
                'phone_number' => '0947702541',
                'password' => Hash::make('12345678'), // Mã hóa mật khẩu
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
