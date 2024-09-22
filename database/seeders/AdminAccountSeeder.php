<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminAccountModel;
use App\Models\RoleAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        AdminAccountModel::create([
            'username' => 'Lương Minh Hoàng - ADMIN',
            'phone_number' => '0947702541',
            'password' => Hash::make('12345678'),
            'email' => 'admin@gmail.com',
            'date_of_birth' => '2004-12-06',
            'role_id' => 1,
        ]);

        AdminAccountModel::create([
            'username' => 'Kiện Ngô - NV_BV',
            'phone_number' => '0987654321',
            'password' => Hash::make('12345678'),
            'email' => 'kienngo@gmail.com',
            'date_of_birth' => '1992-02-02',
            'role_id' => 2,
        ]);

        $faker = Faker::create();

        $roles = [1, 2, 3]; // Admin, Editor, Viewer

        for ($i = 1; $i <= 10; $i++) {
            DB::table('admin_accounts')->insert([
                'id' => $i,
                'username' => $faker->userName,
                'phone_number' => $faker->numerify('##########'),
                'email' => $faker->unique()->safeEmail,
                'date_of_birth' => $faker->date('Y-m-d', '-20 years'),
                'role_id' => $faker->randomElement($roles),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
