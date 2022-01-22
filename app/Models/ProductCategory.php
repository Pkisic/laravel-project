<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    
    protected $table = 'product_categories';
    protected $fillable=['name','description'];


    //RELATIONS
    
    public function products()
    {
        return $this->hasMany(
                Product::class,
                'product_category_id',
                'id'
        );
    }
    
    //HELPER FUNCTIONS
    
    /**
     * Returns product categories from database
     * sorted by priority field
     * 
     * @return Collection [ \App\Model\ProductCategory ]
     */
    public function getAllProductCategories(){
        
        $productCategories = ProductCategory::query()
                                ->orderBy('priority')
                                ->get();
        
        return $productCategories;
    }
    
}
