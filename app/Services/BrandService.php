<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Http\Request;


class BrandService extends BaseService
{
    public function getAllBrands(){
        return Brand::query()
                ->orderBy('name')
                ->get();
    }

    public function insertBrand(Request $request)
    {
        $brand = Brand::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'url' => $request->get('url'),
        ]);
        
        $image = $this->getImageOrFail($request, $brand);
        if($image){
            $brand->update(['image' => $image]);
        }
    }

    public function getImageOrFail(Request $request, $model) : String
    {
        $formData = $request->all();
        if(isset($formData['image']) && !empty($formData['image'])){
            
            $uploadedImage = $request->file('image');
            $name = $model->id . "_" . $uploadedImage->getClientOriginalName();

            $uploadedImage->move(public_path('/storage/'.class_basename($model).'/'), $name);
            return $name;
        }
        return '';
    }
}
