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
            [
                'name' => 'minh nhưt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
