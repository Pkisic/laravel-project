<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Validation\Rule;

class ProductCategoriesController extends Controller
{
    public function index(Request $request)
    {
        $productCategories = ProductCategory::query()
                ->orderBy('priority')
                ->get();
        
        return view('admin.product_categories.index', [
            'productCategories' => $productCategories,
        ]);
    }
    
    public function add(Request $request) 
    {
        return view('admin.product_categories.add', []);
    }
    
    public function insert(Request $request)
    {
        $priority = ProductCategory::max('priority');
        
        $formData = $request->validate([
            'name' => ['required','string','min:2','max:180','unique:product_categories,name'],
            'description' =>['nullable','string','min:10','max:255'],
        ]);
        
        $newProductCategory =new ProductCategory();
        if($priority){
            $newProductCategory->priority = $priority+1;
        }else{
            $newProductCategory->priority = 1;
        }
        
        $newProductCategory->fill($formData);
        
        
        
        $newProductCategory->save();
        
        session()->flash('system_message',__('Product Category Has Been Added'));
        
        return redirect()->route('admin.product_categories.index');
        
    }
    
    public function edit(Request $request, ProductCategory $productCategory)
    {
        return view('admin.product_categories.edit', [
            'productCategory' => $productCategory,
        ]);
    }
    
    public function update(Request $request, ProductCategory $productCategory)
    {
        $formData = $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:180',
                Rule::unique('product_categories')->ignore($productCategory->id)
            ],
            'description' => [
                'required',
                'string',
                'min:10',
                'max:255',
            ],
            
        ]);
        
        $productCategory->fill($formData);
        $productCategory->save();
        session()->flash('system_message', __('Category Has Been Updated!'));
        
        return redirect()->route('admin.product_categories.index');
    }
    
    public function delete(Request $request)
    {
        $formData = $request->validate([
            'id'=>['required', 'numeric', 'exists:product_categories,id']
        ]);
        
        $productCategory = ProductCategory::findOrFail($formData['id']);
        
        $produce = $productCategory->products;
        
        try{
            if(count($produce) > 0){
                throw new \Exception('Delete Unavailable : Category Has Products');
            }
        } catch (\Exception $ex){
            session()->flash('system_error',$ex->getMessage());
            return redirect()->route('admin.product_categories.index');
        }
        
        
        $productCategory->delete();
        
        ProductCategory::query()
                ->where('priority','>',$productCategory->priority)
                ->decrement('priority');
        
        session()->flash('system_message',__('Product Category Has Been Deleted!'));
        
        return redirect()->route('admin.product_categories.index');
    }
    
    public function changePriorities(Request $request)
    {
        $formData = $request->validate([
            'priorities' => ['required','string'],
        ]);
        
        $priorities = explode(',' , $formData['priorities']);
        
        
        foreach($priorities as $key => $id){
            
            $productCategory = ProductCategory::findOrFail($id);
            
            $productCategory->priority = $key + 1;
            
            $productCategory->save();
        }
        
        session()->flash('system_message',__('Product Categories Priorities Have Been ReOrdered!'));
        
        return redirect()->route('admin.product_categories.index');
    }
}
