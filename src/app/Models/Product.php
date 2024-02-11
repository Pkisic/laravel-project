<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    use HasFactory;

    //Mapped to table Products
    protected $table = 'products';
    
    //Table names for mass assignment
    protected $fillable = [
        'name',
        'brand_id',
        'product_category_id',
        'description',
        'price',
        'old_price',
        'featured',
        'details'
        ];

    //RELATIONS
    public function productCategory() {
        
        return $this->belongsTo(ProductCategory::class,
                        'product_category_id',
                        'id'
                );
        
    }
    
    public function brand(){
        
        return $this->belongsTo(Brand::class,
                'brand_id',
                'id');
        
    }
    
    public function sizes()
    {
        return $this->belongsToMany(
            Size::class,
            'product_sizes',
            'product_id',
            'size_id',
        );
    }
    
    
    //HELPER FUNCTIONS
    
    /**
     * Returns a route to the detailed 
     * page for the current Product
     * 
     * @return route
     */
    public function getFrontUrl() {
        
        return route('front.products.single',[
            'product' => $this->id,
            'seoSlug' => \Str::slug($this->name)
        ]);
        
    }
    
    public function getPhoto($photoFieldName){
        
        switch ($photoFieldName){
            case 'photo1':
                return $this->getPhotoUrl();
            case 'photo2':
                return $this->getPhoto2Url();
        }
        
        return url('/themes/front/img/product-img/1.jpg');
    }

    public function getPhotoUrl() {
        if($this->photo1){
            return url('/storage/products/' . $this->photo1);
        }
        return url('/themes/front/img/product-img/1.jpg');
    }
    
    public function deletePhoto1(){
        if(!$this->photo1){
            return $this;
        }
        
        $photoFilePath = public_path('/storage/products/' . $this->photo1);
        
        if(!is_file($photoFilePath)){
            return $this;
        }
        
        unlink($photoFilePath);
        
        return $this;
    }

    public function getPhotoThumbUrl() {
        return url('/themes/front/img/product-img/1.jpg');
    }

    public function getPhoto2Url() {
        if($this->photo2){
            return url('/storage/products/' . $this->photo2);
        }
        return url('/themes/front/img/product-img/2.jpg');
    }
    
    public function deletePhoto2(){
        if(!$this->photo2){
            return $this;
        }
        
        $photoFilePath = public_path('/storage/products/' . $this->photo2);
        
        if(!is_file($photoFilePath)){
            return $this;
        }
        
        unlink($photoFilePath);
        
        return $this;
    }

    public function getPhoto2ThumbUrl() {
        return url('/themes/front/img/product-img/2.jpg');
    }

    public function getPhoto3Url() {
        return url('/themes/front/img/product-img/3.jpg');
    }

    public function getPhoto3ThumbUrl() {
        return url('/themes/front/img/product-img/3.jpg');
    }

    public function getPhoto4Url() {
        return url('/themes/front/img/product-img/4.jpg');
    }

    public function getPhoto4ThumbUrl() {
        return url('/themes/front/img/product-img/4.jpg');
    }
    
    /**
     * Returns newest featured products from database
     * 
     * @return Collection [App\Models\Product]
     */
    public static function getFeaturedProducts(){
        
        $featured = self::query()
                ->where('featured','=',1)
                ->orderBy('created_at','DESC')
                ->limit(10)
                ->get();
        
        return $featured;
    }
    
    /**
     * Retrieves newest four products related by the same category
     * 
     * @return Collection [ App\Model\Product ]
     */
    public function getRelatedProducts()
    {
        $productQuery = Product::query()->with(['productCategory','brand']);
        
        $relatedProducts = $productQuery
                ->where('product_category_id','=',$this->product_category_id)
                ->where('id','!=',$this->id)
                ->latest()
                ->take(4)
                ->get();
        
        return $relatedProducts;
    }


    /**
     * Changes 'featured' column value for the current product.
     * Possible values [ 0 , 1 ]
     * Feature value indicates whether or not it is displayed
     * on the front page of website.
     * 
     * @return $this
     */
    public function toggleSetFeatured(){
        ($this->featured) ? $this->featured = 0 : $this->featured = 1;
        return $this;
    }
    
    /**
     * Returns collection of Products from database
     * uses eager loader
     * 
     * @return Collection [ App\Model\Product ]
     */
    public function getProducts(){
        
        $products = self::query()
                ->with(['brand','productCategory','sizes'])
                ->orderBy('created_at','desc')
                ->get();
        
        return $products;
    }
    
    public function deletePhotos(){
        $this->deletePhoto1();
        $this->deletePhoto2();
        
        return $this;
    }
    
    public function deletePhoto($photoFieldName){
        
        switch ($photoFieldName){
            case 'photo1':
                $this->deletePhoto1();
                break;
            case 'photo2':
                $this->deletePhoto2();
                break;
        }
        
        return $this;
    }
    
}
