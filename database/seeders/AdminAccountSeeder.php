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

        $faker = Faker::create() ;

        $roles = [1, 2, 3]; // Admin, Editor, Viewer

        for ($i = 1; $i <= 10; $i++) {
            DB::table('admin_accounts')->insert([
                'id' => $i,
                'username' => $faker->userName,
                'phone_number' => '0947702541',
                'email' => $faker->unique()->safeEmail,
                'date_of_birth' => $faker->date('Y-m-d', '-20 years'),
                'role_id' => $faker->randomElement($roles),
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
