<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleAdmin;

class RoleAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleAdmin::create([
            'name' => 'Super Admin',
            'description' => 'Vai trò có quyền lớn nhất trong hệ thống',
        ]);

        RoleAdmin::create([
            'name' => 'Nhân Viên Quản Lý Bài Viết',
            'description' => 'Vai trò có quyền thêm, sửa, xóa các bài viết trên hệ thống và đọc bình luận bài viết, trả lời bình luận bài viết.',
        ]);

        RoleAdmin::create([
            'name' => 'Nhân Viên Quản Lý Sản Phẩm',
            'description' => 'Vai trò có quyền thêm, sửa, xóa sản phẩm, đọc bình luận sản phẩm, duyệt bình luận và phản hồi',
        ]);
    }
}
