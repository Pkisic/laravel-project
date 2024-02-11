<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    
    protected $table = 'brands';
    
    protected $guarded = [];
    
    //RELATIONS
    public function products()
    {
        return $this->hasMany(
            Product::class,
            'brand_id',
            'id'
        );
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    
    //HELPER FUNCTIONS
    public function getPhotoUrl()
    {
        if(empty($this->image)){
            return url("/themes/front/img/partner-img/5.jpg");
        }
        return url("/storage/brands/" . $this->image);
    }
    /**
     * 
     *
     * Returns url to the Brand Image path with image name
     * from database from the public/storage/brands/*
     * 
     * @return url | string
     */
    public function getBrandImage()
    {
        if(!empty($this->image)){
            return url("/storage/Brand/" . $this->image);
        }
        $path = $this->images()->first();

        $tmp = is_null($path) ? '' : $path->path;

        return url("/storage/Brand/" . $tmp);
        return url('/themes/front/img/partner-img/5.jpg');
    }
    
    /**
     * Deletes image from current brand in database
     * and from image path ( /storage/brands/* )
     * 
     * @return $this
     */
    public function deleteImage()
    {
        if(empty($this->image)){
            return $this;
        }
        
        $imagePath = public_path('/storage/brands/' . $this->image);
        
        if(!is_file($imagePath)){
            return $this;
        }
        
        unlink($imagePath);
        return $this;
    }
    
    /**
     * All brands from database sorted by name
     * 
     * @return Collection [ App\Model\Brand ]
     */
    public static function getAllBrands()
    {
        $allBrands = self::query()
                ->orderBy('name','ASC')
                ->get();
        
        return $allBrands;
    }
}
