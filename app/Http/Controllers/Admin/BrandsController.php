<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::query()
                ->orderBy('name')
                ->get();
        
        return view('admin.brands.index',[
            'brands' => $brands,
        ]);
    }
    
    public function add()
    {
        return view('admin.brands.add',[]);
    }
    
    public function insert(Request $request)
    {
        
        $formData = $request->validate([
            'name' => ['required','string','unique:brands,name','max:25'],
            'description' => ['string','max:255','nullable'],
            'image' => ['image','nullable'],
            'url' => ['url','active_url','nullable']
        ]);
        
        
        $newBrand = new Brand();
        
        $newBrand->fill($formData);
        
        if(isset($formData['image']) && !empty($formData['image'])){
            
            $uploadedImage = $request->file('image');
            
            $name = $newBrand->id . "_" . $uploadedImage->getClientOriginalName();
            
            
            $uploadedImage->move(public_path('/storage/brands/'), $name);
            
            $newBrand->image = $name;  
        }
        
        $newBrand->save();
        
//        Image::make(public_path('/storage/brands/' . $newBrand->image))
//                ->fit(300,141)
//                ->save();
        
        session()->flash('system_message',__('New Brand has Been Saved!'));
        return redirect()->route('admin.brands.index');
        
    }
    
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit',[
            'brand' => $brand,
        ]);
    }
    
    public function update(Request $request, Brand $brand)
    {
        $formData = $request->validate([
            'name' => ['required','string','max:25', Rule::unique('brands')->ignore($brand->id)],
            'url' => ['nullable','string','url'],
            'image' => ['nullable','file','image'],
            'description' => ['nullable','string','max:255'],
        ]);
        
        $brand->fill($formData);
        
        if(isset($formData['image']) && !empty($formData['image'])){
            
            $uploadedImage = $request->file('image');
            
            $name = $brand->id . "_" . $uploadedImage->getClientOriginalName();
            
            
            $uploadedImage->move(public_path('/storage/brands/'), $name);
            
            $brand->deleteImage();
            $brand->image = $name;
        }
        
        $brand->save();
        session()->flash('system_message',__('Brand Has Been Updated!'));
        
        return redirect()->route('admin.brands.index');
        
    }
    
    public function delete(Request $request)
    {
        
        $formData = Validator::make($request->all(), [
            'id' => ['required','numeric','exists:brands,id'],
        ]);
        
        if($formData->fails()){
            session()->flash('system_error',$formData->errors());
            return redirect()->back();
        }
        
        $brand = Brand::findOrFail($formData['id']);
        
        $produce = $brand->products;
        
        try{
            if(count($produce) > 0){
                throw new \Exception('Delete Unavailable : Brand Has Products');
            }
        } catch (\Exception $ex){
            session()->flash('system_error',$ex->getMessage());
            return redirect()->route('admin.brands.index');
        }
        
        $brand->delete();
        
        session()->flash('system_message',__('Brand Has Been Deleted!'));
        return redirect()->route('admin.brands.index');
    }
    
    public function deletePhoto(Brand $brand) {
        
        $brand->deleteImage();
        $brand->image = null;
        $brand->save();
        
        return response()->json([
            "system_message" => __('Photo has been deleted'),
            "image" => $brand->getBrandImage(),
        ]);
        
    }
}
