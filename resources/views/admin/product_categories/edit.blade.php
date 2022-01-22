@extends('admin._layout.layout')

@section('seo_title',__('Edit Product Category'))

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('Edit Category')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.product_categories.index')}}">@lang('Categories')</a></li>
                        <li class="breadcrumb-item active">@lang('Edit size')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('Editing Category: ')</h3>
                            #{{$productCategory->id}}
                            <hr>
                            {{$productCategory->name}}
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form"  
                              action="{{route('admin.product_categories.update',['productCategory' => $productCategory->id])}}" 
                              method="post" 
                              id="entity-form"
                              >
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input
                                        name="name"
                                        value="{{old('name', $productCategory->name)}}"
                                        type="text" 
                                        class="form-control @if($errors->has('name')) is-invalid @endif"
                                        placeholder="Enter name"
                                        >
                                    @include('admin._layout.partials.form_errors',['fieldName' => 'name'])
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea
                                        name="description" 
                                        class="form-control @if($errors->has('name')) is-invalid @endif"
                                        >{{old('description', $productCategory->description)}}</textarea>
                                    @include('admin._layout.partials.form_errors',['fieldName' => 'description'])
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button 
                                    type="submit" 
                                    class="btn btn-primary"
                                    >@lang('Save')</button>
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
                minlength:2,
                maxlength: 180
            },
            "description":{
                required:true,
                minlength:10,
                maxlength:255,
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