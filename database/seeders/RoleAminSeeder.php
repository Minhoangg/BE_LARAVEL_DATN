<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleAminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_admin')->insert([
            [
                'name' => "Admin",
                'description' => "Full access to all system features",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "Editor",
                'description' => "Can edit and publish content",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "Viewer",
                'description' => "Can only view content",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
