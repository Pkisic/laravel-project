@extends('admin._layout.layout')
@section('seo_title' ,__('Add User'))
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('Users Form')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">@lang('Users')</a></li>
                        <li class="breadcrumb-item active">@lang('Add User')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('Add User')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form 
                            action="{{route('admin.users.insert')}}" 
                            method="post"
                            id="entity-form"
                            enctype="multipart/form-data"
                            role="form"
                            >
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('Email')</label>
                                            <div class="input-group">
                                                <input 
                                                    name="email"
                                                    type="email"
                                                    value="{{old('email')}}"
                                                    class="form-control  @if($errors->has('email')) is-invalid @endif" 
                                                    placeholder="Enter email"
                                                    >
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        @
                                                    </span>
                                                </div>
                                                @include('admin._layout.partials.form_errors' , ['fieldName' => 'email'])
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('Name')</label>
                                            <input 
                                                type="text" 
                                                name="name"
                                                value="{{old('name')}}"
                                                class="form-control @if($errors->has('name')) is-invalid @endif" 
                                                placeholder="Enter name"
                                                >
                                            @include('admin._layout.partials.form_errors', ['fieldName'=> 'name'])
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('Phone')</label>
                                            <div class="input-group">
                                                <input 
                                                    type="text" 
                                                    name="phone"
                                                    value="{{old('phone')}}"
                                                    class="form-control @if($errors->has('phone')) is-invalid @endif" 
                                                    placeholder="Enter phone"
                                                    >
                                                @include('admin._layout.partials.form_errors', ['fieldName'=> 'phone'])
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('Choose New Photo')</label>
                                            <input 
                                                name="image"
                                                type="file" 
                                                class="form-control @if($errors->has('image')) is-invalid @endif"
                                                >
                                            @include('admin._layout.partials.form_errors', ['fieldName'=> 'image'])
                                        </div>
                                    </div>
                                    <div class="offset-md-3 col-md-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>@lang('Photo')</label>

                                                    <div class="text-right">
                                                        <button type="button" class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-remove"></i>
                                                            @lang('Delete Photo')
                                                        </button>
                                                    </div>
                                                    <div class="text-center">
                                                        <img src="https://via.placeholder.com/400x600" alt="" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang('Save')</button>
                                <a href="{{route('admin.users.index')}}" class="btn btn-outline-secondary">@lang('Cancel')</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@push('footer_javascript')
<script type="text/javascript">

    $('#entity-form').validate({
        rules:{
            "email":{
                "required":true,
            },
            "name":{
                "required":true,
            },
            "image":{
                accept: "image/*"
            }
        },
        errorElement:'span',
        errorPlacement:function(error,element){
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight:function(element,errorClass,validClass){
            $(element).addClass('is-invalid');
        },
        unhighlight:function(element,errorClass,validClass){
            $(element).removeClass('is-invalid');
        }
    });

</script>
@endpush