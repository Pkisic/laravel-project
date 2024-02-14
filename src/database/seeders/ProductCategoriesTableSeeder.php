<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \DB;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->truncate();
        
        $faker = \Faker\Factory::create();
        
        for($i = 1; $i<=10; $i++){
            DB::table('product_categories')->insert([
                'priority' => $i,
                'name' => $faker->jobTitle,
                'description' => $faker->realText,
                'created_at' => $faker->dateTimeBetween('-6 months','now'),
                'updated_at' => $faker->dateTimeBetween('-6 months','now')
            ]);
        }
    }
}
