<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    
    public function edit(Request $request)
    {
        $user = \Auth::user();
        
        return view('admin.profile.edit',[
            'user' => $user,
        ]);
    }
    
    public function update(Request $request)
    {
        $user = \Auth::user();
        //validation
        $validator = Validator::make($request->all(),[
            'name' => ['required',
                'string',
                'max:255',
                'min:2',
                Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable','string'],
            'image' => ['nullable','file','image']
        ]);
        //validation fails
        if($validator->fails()){
            session()->flash('system_error',__('User updating failed!'));
            return redirect()->back()->withErrors($validator);
        }
        
        $validated = $validator->validated();
        $user->fill($validated);
        $user->save();
        $this->handleUserImage($request, $user);
        session()->flash('system_message', __('Your profile has been saved'));
        return redirect()->route('admin.profile.edit');
    }
    
    public function changePassword(Request $request)
    {
        return view('admin.profile.change_password',[]);
    }
    
    public function changePasswordConfirm(Request $request)
    {
        $user = \Auth::user();
        
        $formData = $request->validate([
            'old_password' => [
                'required',
                function($attribute,$value,$fail) use ($user){
                    if(!\Hash::check($value, $user->password)){
                        $fail('Your old password is not correct!');
                    }
                }
                ],
            'new_password' => ['required','string','min:8'],
            'new_password_confirm' => ['required','same:new_password'],
        ]);

        $user->password = \Hash::make($formData['new_password']);
        $user->save();
        
        session()->flash('system_message' , __('Your password has been changed'));
        return redirect()->route('admin.profile.edit');
    }
    
    public function handleUserImage(Request $request)
    {
        $user = \Auth::user();
        
        if($request->hasFile('image')){
            $user->deleteImage();
            $image = $request->file('image');
            
            $fileName = $user->id . '_' . $image->getClientOriginalName();

            $image->move(
                    public_path('/storage/users/'),
                    $fileName
                    );
            
            $user->image = $fileName;
            $user->save();
            
            \Image::make(public_path('/storage/users/' . $user->image))
                    ->resize(300,300)
                    ->save();
        }
    }
    
    public function deleteImage(Request $request)
    {
        $user = \Auth::user();
        $user->deleteImage();
        $user->save();
        
        return response()->json([
            'system_message' => __('Image has been deleted!'),
            'image_url' => $user->getImageUrl()
        ]);
    }
}
