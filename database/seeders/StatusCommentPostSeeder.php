<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusCommentPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_comment_posts')->insert([
            [
                
                'name' => "Đã duyệt",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
