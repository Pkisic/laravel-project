<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
class IndexController extends Controller
{
    public function index()
    {
        
        $featuredProducts = Product::getFeaturedProducts();
        
        $allBrands = Brand::getAllBrands();
        
        return view('front.index.index',[
            'allBrands' => $allBrands,
            'featuredProducts' => $featuredProducts,
        ]);
    }
    
    public function aboutUs()
    {
        return view('front.index.about_us',[]);
    }
    
    public function terms()
    {
        return view('front.index.terms',[]);
    }
}
