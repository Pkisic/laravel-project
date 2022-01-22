@if($errors->has($fieldName))
<div class="invalid-feedback">
    @foreach($errors->get($fieldName) as $errMsg)
    <div class="danger">{{$errMsg}}</div>
    @endforeach
</div>
@endif