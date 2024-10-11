<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            RoleAminSeeder::class,
            AdminAccountSeeder::class,
            Users_Seeder::class,
            Post_Categories_Seeder::class,
            Posts_Seeder::class,
            StatusCommentPostSeeder::class,
            CommentPostSeeder::class,   
            ProductCategoriesSeeder::class,

            VariantsSeeder::class,
            VariantAttributesSeeder::class,
            ProductCategoriesSeeder::class,
            BrandsSeeder::class,

            ParentProductsSeeder::class,
            ProductsSeeder::class,
            ProductCategoriesVariantSeeder::class,

            ShippingAddressSeeder::class,
        ]);
    }
}
