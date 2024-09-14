<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminAccountModel;
use App\Models\RoleAdmin;
use Illuminate\Support\Facades\Hash;


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
    }
}
