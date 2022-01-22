@if(\Auth::user()->email != $user->email)
<div class="btn-group">
    <a href="{{route('admin.users.edit', ['user' => $user->id])}}" class="btn btn-info">
        <i class="fas fa-edit"></i>
    </a>
    <button 
        type="button" 
        class="btn btn-info" 
        data-toggle="modal" 
        data-target="{{($user->active) ? '#disable-modal' : '#enable-modal'}}"
        
        data-action="toggleUserActive"
        data-id="{{$user->id}}"
        data-name="{{$user->name}}"
        >
        <i class="fas {{($user->active) ? 'fa-minus-circle' : 'fa-check'}}"></i>
    </button>
    <button 
        type="button" 
        class="btn btn-info" 
        data-toggle="modal" 
        data-target="#delete-modal"
        
        data-action="delete"
        data-id="{{$user->id}}"
        data-name="{{$user->name}}"
        >
        <i class="fas fa-trash"></i>
    </button>
</div>
@endif