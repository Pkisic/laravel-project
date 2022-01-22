<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UsersController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.users.index',[]);
    }
    
    public function datatable(Request $request)
    {
        $searchFilters = $request->validate([
            'name' => ['nullable', 'string'],
            'active' => ['nullable','in:0,1'],
            'email' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
        ]);
        
        $query = User::query();
        
        //inicijalizacija DataTables
        $dataTable = \DataTables::of($query);
        
        $dataTable->addColumn('actions', function($user){
            return view('admin.users.partials.actions', ['user' => $user]);
        })->editColumn('name',function($user){
            return '<strong>' . e($user->name) . '</strong>';
        })->editColumn('active',function($user){
            return view('admin.users.partials.status', ['user' => $user]);
        })->editColumn('image', function($user){
            return view('admin.users.partials.profile_image', ['user' => $user]);
        })->editColumn('id', function($user){
            return ' # ' . e($user->id);
        });
        
        $dataTable->rawColumns(['name', 'id']);
        
        $dataTable->filter(function($query) use ($request, $searchFilters){
            
            if($request->has('search') && is_array($request->get('search')) && isset($request->get('search')['value'])){
                
                $searchTerm = $request->get('search')['value'];
                
                $query->where(function($query) use($searchTerm){
                    
                    $query->orWhere('users.name', 'LIKE','%' . $searchTerm . '%')
                            ->orWhere('users.email','LIKE','%' . $searchTerm . '%')
                            ->orWhere('users.phone','LIKE','%' . $searchTerm . '%')
                            ->orWhere('users.active','LIKE', $searchTerm);
                });
            }
            if (isset($searchFilters['name'])) {
                $query->where('users.name', 'LIKE', '%' . $searchFilters['name'] . '%');
            }

            if (isset($searchFilters['email'])) {
                $query->where('users.email', 'LIKE', '%' . $searchFilters['email'] . '%');
            }

            if (isset($searchFilters['phone'])) {
                $query->where('users.phone', 'LIKE', '%' . $searchFilters['phone'] . '%');
            }

            if (isset($searchFilters['active'])) {
                $query->where('users.active', '=', $searchFilters['active']);
            }
        });
        
        return $dataTable->make(true);
    }
    
    public function add()
    {
        return view('admin.users.add',[]);
    }
    
    public function insert(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(),[
            'name' => ['required','string','max:255','min:2','unique:users,name'],
            'email' => ['required','email','unique:users,email'],
            'phone' => ['nullable','string'],
            'image' => ['nullable','file','image']
        ]);
        //validation fails
        if($validator->fails()){
            session()->flash('system_error',__('User credentials wrong!'));
            return redirect()->back()->withErrors($validator);
        }
        
        $validated = $validator->validated();
        $newUser = new User();
        $newUser->fill($validated);
        $newUser->password = Hash::make('cubesphp');
        $newUser->save();
        
        $this->handleUserImage($request, $newUser);
        
        session()->flash('system_message', __('New User Has Been Saved!'));
        return redirect()->route('admin.users.index');
    }
    
    public function edit(Request $request, User $user)
    {
        if($user->id == \Auth::user()->id){
            session()->flash('system_error', __('You are not allowed to modify your account!'));
            return redirect()->route('admin.users.index');
        }
        
        return view('admin.users.edit',[
            'user' => $user,
        ]);
    }
    
    public function update(Request $request, User $user)
    {
        if($user->id == \Auth::user()->id){
            session()->flash('system_error', __('You are not allowed to update your account!'));
            return redirect()->route('admin.users.index');
        }
        //validation
        $validator = Validator::make($request->all(),[
            'name' => ['required',
                'string',
                'max:255',
                'min:2',
                Rule::unique('users')->ignore($user->id)],
            'email' => ['required',
                'email',
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
        session()->flash('system_message', __('User has been Updated!'));
        return redirect()->route('admin.users.index');
    }
    
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'numeric', 'exists:users,id'],
        ]);
        
        $validated = $validator->validated();
        
        if($validator->fails()){
            return response()->json([
                'system_error' => 'Wrong user credentials!'
            ],400);
        }elseif($validated['id'] == \Auth::user()->id){
            return response()->json([
                'system_error' => 'You are not allowed to delete your account!'
            ],400);
        }
        
        $user= User::findOrFail($validated['id']);
        $user->deleteImage();
        $user->delete();
        
        return response()->json([
            'system_message' => $user->name . ' has been deleted!',
        ]);
    }
    
    public function toggleActive(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'numeric', 'exists:users,id'],
        ]);
        
        $validated = $validator->validated();
        
        if($validator->fails()){
            return response()->json([
                'system_error' => 'Wrong User Credentials!',
            ],400);
        }elseif($validated['id'] == \Auth::user()->id){
            $msg = (\Auth::user()->active) ? __('disable') : __('enable');
            return response()->json([
                'system_error' => 'You are not allowed to ' . $msg . ' yourself!'
            ],400);
        }
        //finds, changes and saves user
        $user = User::findOrFail($request->get('id'));
        $user->setActive()->save();
        //message generated according to state
        $message = ($user->active) ? __($user->name . ' set to active') : __($user->name . ' set to inactive');
        
        return response()->json([
            'system_message' => $message,
        ]);
    }
    
    public function handleUserImage(Request $request , User $user)
    {
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
    
    public function deleteImage(Request $request, User $user)
    {
        $user->deleteImage();
        $user->save();
        
        return response()->json([
            'system_message' => __('Image has been deleted!'),
            'image_url' => $user->getImageUrl()
        ]);
    }
}
