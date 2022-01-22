@extends('admin._layout.layout')

@section('seo_title',__('Brands'))

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('Brands')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Brands')</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('All Brands')</h3>
                            <div class="card-tools">
                                <a href="{{route('admin.brands.add')}}" class="btn btn-success">
                                    <i class="fas fa-plus-square"></i>
                                    @lang('Add new Brand')
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="entities-list-table" class="table table-bordered">
                                <thead>                  
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th class="text-center">@lang('Photo')</th>
                                        <th style="width: 20%;">@lang('Name')</th>
                                        <th style="width: 30%;">@lang('Website')</th>
                                        <th class="text-center">@lang('Created At')</th>
                                        <th class="text-center">@lang('Last Change')</th>
                                        <th class="text-center">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($brands->count()))
                                    @foreach($brands as $brand)
                                    <tr>
                                        <td>#{{$brand->id}}</td>
                                        <td class="text-center">
                                            <img src="{{$brand->getBrandImage()}}" style="max-width: 80px;">
                                        </td>
                                        <td>
                                            <strong>{{$brand->name}}</strong>
                                        </td>
                                        <td>
                                            <a href="{{$brand->url}}">{{$brand->url}}</a>
                                        </td>
                                        <td class="text-center">{{$brand->created_at}}</td>
                                        <td class="text-center">{{$brand->updated_at}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{route('admin.brands.edit', ['brand' => $brand->id])}}" 
                                                   class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-info" 
                                                        data-toggle="modal" 
                                                        data-target="#delete-modal"

                                                        data-action="delete"
                                                        data-id="{{$brand->id}}"
                                                        data-name="{{$brand->name}}"
                                                        >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <form class="modal fade" id="delete-modal" action="{{route('admin.brands.delete')}}" method="POST">
        @csrf
        <input type="hidden" name="id" value="" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Delete Brand')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to delete brand?')</p>
                    <strong data-container="name"></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Cancel')</button>
                    <button type="submit" class="btn btn-danger">@lang('Delete')</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->
</div>
<!-- /.content-wrapper -->
@endsection

@push('footer_javascript')

<script type="text/javascript">

    $('#entities-list-table').on('click', '[data-action="delete"]', function (e) {

        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');

        $('#delete-modal [name="id"]').val(id);
        $('#delete-modal [data-container="name"]').html(name);

    });

</script>

@endpush