<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;
use App\Models\Product;
use \DB;
class ProductSizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_sizes')->truncate();
        
        $sizeId = Size::query()->get()->pluck('id');
        $productIds = Product::query()->get()->pluck('id');
        
        foreach ($productIds as $productId) {
            $randomSizeIds = $sizeId->take(rand(3,5));
            
            foreach($randomSizeIds as $randomSizeId){
                DB::table('product_sizes')->insert([
                    'product_id' => $productId,
                    'size_id' => $randomSizeId,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
        
    }
}
