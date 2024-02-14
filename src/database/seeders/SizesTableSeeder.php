<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \DB;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
        DB::table('sizes')->truncate();
        
        $sizeNames = ['XS','S','M','L','XL','XXL'];
        
        foreach($sizeNames as $sizeName){
            DB::table('sizes')->insert([
            'name' => $sizeName,
            'priority' => ++$i,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
