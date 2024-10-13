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
            'city_code' => 217,
            'district_code' => 1756,
            'ward_code' => 510513,
            'street_address' => '123 Hoang Cau',
        ]);

    }
}
