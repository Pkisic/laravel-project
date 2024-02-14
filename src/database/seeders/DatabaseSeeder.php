<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BrandsTableSeeder::class);
        $this->call(ProductCategoriesTableSeeder::class);
        $this->call(SizesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductSizesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
