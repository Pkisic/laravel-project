<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \DB;
use \Faker\Factory as FakerFactory;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        $faker = FakerFactory::create();
        
        $productCategoryIds = DB::table('product_categories')->get()->pluck('id');
        $brandsIds = DB::table('brands')->get()->pluck('id');
        
        for($i = 1; $i<=1000; $i++){
            DB::table('products')->insert([
                'name' => $faker->city,
                'description' => $faker->realText(200),
                'price' => rand(5000, 10000)/100,
                'old_price' => rand(10000, 100000)/100,
                'brand_id' => $brandsIds->random(),
                'product_category_id' => $productCategoryIds->random(),
                'featured'=> rand(100,999) % 2,
                'created_at' => $faker->dateTimeBetween('-6 months','now'),
                'updated_at' => $faker->dateTimeBetween('-6 months','now')
            ]);
        }
    }
}
