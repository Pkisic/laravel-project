<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Brand;
use App\Models\Size;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $formData = $request->validate([
            'product_category_id' => ['nullable', 'array', 'exists:product_categories,id'],
            'brands_id' => ['nullable', 'array', 'exists:brands,id'],
            'sizes_id' => ['nullable','array','exists:sizes,id'],
        ]);
        
        $productCategories = ProductCategory::query()
                ->orderBy('name')
                ->withCount(['products'])
                ->get();
        
        $brands = Brand::query()
                ->orderBy('name')
                ->withCount(['products'])
                ->get();
        
        $sizes = Size::query()
                ->orderBy('name')
                ->withCount(['products'])
                ->get();
        
        $productQuery = Product::query()->with(['productCategory','brand']);
        
        if(isset($formData['product_category_id'])){
            $productQuery->whereIn('product_category_id',$formData['product_category_id']);
        }
        
        if(isset($formData['brands_id'])){
            $productQuery->whereIn('brand_id',$formData['brands_id']);
        }
        
        if(isset($formData['sizes_id'])){
            $productQuery
                    ->leftJoin('product_sizes','products.id','=','product_sizes.product_id')
                    ->select('products.*','product_sizes.size_id')
                    ->whereIn('size_id',$formData['sizes_id']);
        }
        
        $productQuery->latest();

        $products = $productQuery->paginate(12);
        
        $products->appends($formData);
        
        return view('front.products.index',[
            'products' => $products,
            'productCategories' => $productCategories,
            'brands' => $brands,
            'sizes' => $sizes,
            'formData' => $formData,
        ]);
    }
    
    public function single(Request $request, Product $product, $seoSlug = null) 
    {
        
        if($seoSlug != \Str::slug($product->name)){
            return redirect()->away($product->getFrontUrl());
        }
        $relatedProducts = $product->getRelatedProducts();
        
        return view('front.products.single',[
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
        
    }
}
