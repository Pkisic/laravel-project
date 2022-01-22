<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Size;

class SizesController extends Controller
{
    
    public function index(Request $request) 
    {
        $sizes = Size::query()
                ->orderBy('priority')
                ->get();
        
        return view('admin.sizes.index',[
            'sizes' => $sizes,
        ]);
    }
    
    public function add(Request $request)
    {
        
        return view('admin.sizes.add',[
            
        ]);
    }
    
    public function insert(Request $request) 
    {
        
        $formData = $request->validate([
            'name' => ['required' , 'string' , 'max:10' , 'unique:sizes,name']
        ]);
        
        $newSize = new Size();
        
        $newSize->fill($formData);
        $newSize->save();
        
        session()->flash('system_message', __('New Size Has Been Saved!'));
        return redirect()->route('admin.sizes.index');
        
    }
    
    public function edit(Request $request, Size $size) 
    {
        
        return view('admin.sizes.edit', [
            'size' => $size,
        ]);
        
    }
    
    public function update(Request $request, Size $size) 
    {
        
        $formData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:10',
                Rule::unique('sizes')->ignore($size->id),
            ],
        ]);


        $size->fill($formData);

        $size->save(); 

        session()->flash('system_message', __('Size Has Been Updated!'));

        return redirect()->route('admin.sizes.index');
    }
    
    public function delete(Request $request) 
    {
        $formData = $request->validate([
            'id' => ['required','numeric','exists:sizes,id'],
        ]);
        
        $size =  Size::findOrFail($formData['id']);
        
        $size->products()->detach();
        
        $size->delete();
        
        
        session()->flash('system_message', __('Size Has Been Deleted!'));

        return redirect()->route('admin.sizes.index');
    }
    
    public function changePriorities(Request $request)
    {
        $formData = $request->validate([
            'priorities' => ['required','string'],
        ]);
        
        $priorities = explode(',', $formData['priorities']);
        
        foreach($priorities as $key => $id){
            
            $size = Size::findOrFail($id);
            $size->priority = $key + 1;
            $size->save();
            
        }
        
        session()->flash('system_message',__('Sizes Priorities Have Been ReOrdered!'));
        return redirect()->route('admin.sizes.index');
        
    }
    
}
