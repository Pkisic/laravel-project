@if($user->active == 1)
<span class="text-success">@lang('enabled')</span>
@elseif($user->active == 0)
<span class="text-danger">@lang('disabled')</span>
@endif