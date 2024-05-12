<?php

namespace Database\Seeders;

use \Illuminate\Support\Facades\DB;
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
    }
}
