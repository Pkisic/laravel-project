<?php

namespace Database\Seeders;

use \DB;
use \Faker\Factory as FakerFactory;
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
        DB::table('users')->truncate();
        $faker = FakerFactory::create();
        
        DB::table('users')->insert([
            'name' => 'Predrag Kisic',
            'email' => 'admin@admin.com',
            'phone' => $faker->phoneNumber(),
            'active' => 1,
            'password' => bcrypt('admin'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        for($i = 0 ; $i<20 ; $i++){
            DB::table('users')->insert([
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
