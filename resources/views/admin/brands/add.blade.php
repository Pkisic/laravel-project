@extends('admin._layout.layout')

@section('seo_title',__('Add Brand'))

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brands Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.brands.index')}}">@lang('Brands')</a></li>
                        <li class="breadcrumb-item active">@lang('Add Brand Form')</li>
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
                            <h3 class="card-title">@lang('Add Brand')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('admin.brands.insert')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('Name')</label>
                                            <input 
                                                type="text" 
                                                class="form-control @if($errors->has('name')) is-invalid @endif" 
                                                placeholder="@lang('Enter name')"
                                                name="name"
                                                value="{{old('name')}}"
                                                >
                                            @include('admin._layout.partials.form_errors',['fieldName' => 'name'])
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('Description')</label>
                                            <textarea 
                                                class="form-control @if($errors->has('description')) is-invalid @endif" 
                                                placeholder="@lang('Enter description')"

                                                name="description"
                                                >{{old('description')}}</textarea>
                                            @include('admin._layout.partials.form_errors',['fieldName' => 'description'])
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('Website')</label>
                                            <input 
                                                name="url"
                                                type="URL" 
                                                class="form-control @if($errors->has('url')) is-invalid @endif" 
                                                placeholder="@lang('Enter url of Website')"
                                                value="{{old('url')}}"
                                                >
                                            @include('admin._layout.partials.form_errors',['fieldName' => 'url'])
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('Choose New Photo')</label>
                                            <input 
                                                type="file" 
                                                class="form-control @if($errors->has('image')) is-invalid @endif"
                                                name="image"
                                                id="image"
                                                >
                                            @include('admin._layout.partials.form_errors',['fieldName' => 'image'])
                                        </div>
                                    </div>
                                    <div class="offset-md-1 col-md-5">
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
                                <a href="{{route('admin.brands.index')}}" class="btn btn-outline-secondary">@lang('Cancel')</a>
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
        rules: {
            "name": {
                required: true,
                maxlength: 25
            },
            "description": {
                maxlength: 255,
            },
            "url":{
                url:true,
            },
            "image":{
                accept:"image/*",
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

</script>
@endpush