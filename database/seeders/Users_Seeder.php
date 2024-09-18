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

        // Array to hold the data for 20 users
        $users = [];

        // Create 20 sample users
        for ($i = 1; $i <= 20; $i++) {
            $users[] = [
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'phone_number' => '090000000' . $i,
                'password' => Hash::make('password' . $i), // Encrypt password
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the users into the 'users' table
        DB::table('users')->insert($users);
    }
}
