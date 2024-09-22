<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CommentPostSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Lấy tất cả các post_id hiện có
        $postIds = DB::table('posts')->pluck('id')->toArray();

        // Lấy tất cả các user_id hiện có
        $userIds = DB::table('users')->pluck('id')->toArray();

        // Lấy tất cả các id_status_comment hiện có
        $statusCommentIds = DB::table('status_comment_posts')->pluck('id')->toArray();

        // Tạo 50 bình luận
        for ($i = 0; $i < 50; $i++) {
            $parentId = $faker->boolean(30) ? $faker->numberBetween(1, $i) : null;

            DB::table('comment_posts')->insert([
                'content' => $faker->sentence,
                'post_id' => $faker->randomElement($postIds),
                'user_id' => $faker->randomElement($userIds),
                'parent_id' => $parentId,
                'id_status_comment' => $faker->randomElement($statusCommentIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
