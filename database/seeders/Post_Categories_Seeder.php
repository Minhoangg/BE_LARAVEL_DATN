<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Post_Categories_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo dữ liệu mẫu cho bảng users
        DB::table('post_categories')->insert([
            ['name' => 'Tin tức', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Công nghệ', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Thể thao', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Giải trí', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kinh doanh', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Khoa học', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sức khỏe', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Du lịch', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Giáo dục', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ẩm thực', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
