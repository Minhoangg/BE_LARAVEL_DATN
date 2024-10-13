<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingAddressModel;

class ShippingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingAddressModel::create([
            'user_id' => 1,
            'city' => 'Hanoi',
            'district' => 'Dong Da',
            'ward' => 'Lang Ha',
            'street_address' => '123 Hoang Cau',
        ]);

    }
}
