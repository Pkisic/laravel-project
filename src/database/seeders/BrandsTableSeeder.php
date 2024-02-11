<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('brands')->truncate();
        
        $faker = \Faker\Factory::create();
        
        for($i = 1; $i <= 20; $i++){
            \DB::table('brands')->insert([
                'name' => $faker->company,
                'description' => $faker->realText,
                'created_at' => $faker->dateTimeBetween('-6 months','now'),
                'updated_at' => $faker->dateTimeBetween('-6 months','now')
            ]);
        }
    }
}
