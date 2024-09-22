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

        $posts = [];
        for ($i = 1; $i <= 10; $i++) {
            $posts[] = [
                'title' => "Bài viết mẫu số $i",
                'id_admin_account' => rand(1, 2), // Giả sử có 5 admin account
                'categories_id' => rand(1, 3), // Giả sử có 3 danh mục
                'tag' => "tag$i",
                'content' => "Đây là nội dung của bài viết mẫu số $i",
                'author' => "Tác giả $i",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
