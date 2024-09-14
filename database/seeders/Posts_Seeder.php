<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Posts_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo dữ liệu mẫu cho bảng users
        DB::table('posts')->insert([
            [
                'title' => '6 Cách Đơn Giản Để Viết Bài Viết Hiệu Quả Và Chất Lượng',
                'id_admin_account' => 1,
                'category_id' => 1,
                'tag' => 'tag',
                'content' => 'nôi dung',
                'author' => 'minhnhut', // Mã hóa mật khẩu
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
