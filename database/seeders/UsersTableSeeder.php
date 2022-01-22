<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();
        
        \DB::table('users')->insert([
            'name' => 'Predrag Kisic',
            'email' => 'pedjakisic@gmail.com',
            'phone' => '0644482829',
            'active' => 1,
            'password' => bcrypt('Marijana2013'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        \DB::table('users')->insert([
            'name' => 'Marijana Bilic',
            'email' => 'mbilic@gmail.com',
            'phone' => '0638782837',
            'active' => 1,
            'password' => bcrypt('cubesPhp'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        $faker = \Faker\Factory::create();
        
        for($i = 0 ; $i<20 ; $i++){
            \DB::table('users')->insert([
            'name' => $faker->name(),
            'email' => $faker->email(),
            'phone' => $faker->phoneNumber(),
            'active' => 1,
            'password' => bcrypt('cubesPhp'),
            'created_at' => $faker->dateTimeBetween('-6 months','now'),
            'updated_at' => $faker->dateTimeBetween('-6 months','now')
        ]);
        }
    }
}
