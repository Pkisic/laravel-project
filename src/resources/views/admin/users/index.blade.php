@extends('admin._layout.layout')
@section('seo_title' ,__('Users'))
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('Users')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Users')</li>
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
                            <h3 class="card-title">@lang('Search Users')</h3>
                            <div class="card-tools">
                                <a href="{{route('admin.users.add')}}" class="btn btn-success">
                                    <i class="fas fa-plus-square"></i>
                                    @lang('Add new User')
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="entities-filter-form">
                                <div class="row">
                                    <div class="col-md-1 form-group">
                                        <label>@lang('Status')</label>
                                        <select name="active" class="form-control">
                                            <option value="">-- @lang('All') --</option>
                                            <option value="1">@lang('enabled')</option>
                                            <option value="0">@lang('disabled')</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>@lang('Email')</label>
                                        <input 
                                            name="email" 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Search by email">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>@lang('Name')</label>
                                        <input 
                                            name="name" 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Search by name">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>@lang('Phone')</label>
                                        <input 
                                            name="phone" 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Search by phone">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('All Users')</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered" id="entities-list-table">
                                <thead>                  
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th style="width: 20px">@lang('Status')</th>
                                        <th class="text-center">@lang('Photo')</th>
                                        <th>@lang('Email')</th>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Phone')</th>
                                        <th class="text-center">@lang('Created At')</th>
                                        <th class="text-center">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody><?php /*
                                    <tr>
                                        <td>#1</td>
                                        <td class="text-center">
                                            <span class="text-success">@lang('enabled')</span>
                                        </td>
                                        <td class="text-center">
                                            <img src="https://via.placeholder.com/200" style="max-width: 80px;">
                                        </td>
                                        <td>
                                            user1@example.com
                                        </td>
                                        <td>
                                            <strong>User 1</strong>
                                        </td>
                                        <td>
                                            +38165555777
                                        </td>
                                        <td class="text-center">2020-02-02 12:00:00</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#disable-modal">
                                                    <i class="fas fa-minus-circle"></i>
                                                </button>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#delete-modal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#2</td>
                                        <td class="text-center">
                                            <span class="text-danger">disabled</span>
                                        </td>
                                        <td class="text-center">
                                            <img src="https://via.placeholder.com/200" style="max-width: 80px;">
                                        </td>
                                        <td>
                                            user2@example.com
                                        </td>
                                        <td>
                                            <strong>User 2</strong>
                                        </td>
                                        <td>
                                            +38165555666
                                        </td>
                                        <td class="text-center">2020-02-02 12:00:00</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#enable-modal">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#delete-modal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#3</td>
                                        <td class="text-center">
                                            <span class="text-success">enabled</span>
                                        </td>
                                        <td class="text-center">
                                            <img src="https://via.placeholder.com/200" style="max-width: 80px;">
                                        </td>
                                        <td>
                                            MOJNALOG@example.com
                                        </td>
                                        <td>
                                            <strong>MOJE IME</strong>
                                        </td>
                                        <td>
                                            +38165555888
                                        </td>
                                        <td class="text-center">2020-02-02 12:00:00</td>
                                        <td class="text-center">

                                        </td>
                                    </tr>*/?>
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

    <form action="{{route('admin.users.delete')}}" method="POST" class="modal fade" id="delete-modal">
        @csrf
        <input type="hidden" name="id" value="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Delete User')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to delete user')?</p>
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
    <form action="{{route('admin.users.isactive')}}" method="POST" class="modal fade" id="disable-modal">
        @csrf
        <input type="hidden" name="id" value="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Disable User')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to disable user')?</p>
                    <strong data-container="name"></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Cancel')</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-minus-circle"></i>
                        @lang('Disable')
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->

    <form action="{{route('admin.users.isactive')}}" method="POST" class="modal fade" id="enable-modal">
        @csrf
        <input type="hidden" name="id" value="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Enable User')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to enable user')?</p>
                    <strong data-container="name"></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Cancel')</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i>
                        @lang('Enable')
                    </button>
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

    $('#entities-filter-form [name]').on('change keyup', function(e){
       $('#entities-filter-form').trigger('submit'); 
    });
    
    $('#entities-filter-form').on('submit', function(e){
        e.preventDefault();
        entitiesDataTable.ajax.reload(null, false);
    });

    let entitiesDataTable = $('#entities-list-table').DataTable({
        "serverSide":true,
        "processing":true,
        "ajax":{
            "url":"{{route('admin.users.datatable')}}",
            "type":"post",
            "data":function(dtData){
                dtData["_token"] = "{{csrf_token()}}";
                
                dtData["active"] = $('#entities-filter-form [name="active"]').val();
                dtData["email"] = $('#entities-filter-form [name="email"]').val();
                dtData["name"] = $('#entities-filter-form [name="name"]').val();
                dtData["phone"] = $('#entities-filter-form [name="phone"]').val();
            }
        },
        "order":[[0,'asc']],
        "pageLength":5,
        "lengthMenu":[5,10,25,50],
        "columns":[
            {
                "name":"id",
                "data":"id"
            },
            {
                "name":"status",
                "data":"active",
                "className": "text-center",
                "orderable": false,
            },
            {
                "name":"image",
                "data":"image",
                "className": "text-center",
                "orderable": false,
                "searchable": false,
            },
            {
                "name":"email",
                "data":"email"
            },
            {
                "name":"name",
                "data":"name"
            },
            {
                "name":"phone",
                "data":"phone",
                "orderable": false,
            },
            {
                "name":"created_at",
                "data":"created_at",
                "className": "text-center",
            },
            {
                "name":"actions",
                "data":"actions",
                "className": "text-center",
                "orderable": false,
                "searchable": false,
            },
        ]
    });
    
    //sets the desired values on delete modal after clicking the delete user interface
    $('#entities-list-table').on('click', '[data-action="delete"]', function(e){
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');
        
        $('#delete-modal [name="id"]').val(id);
        $('#delete-modal [data-container="name"').html(name);
    });
    
    //sets the desired values on modals after clicking for changing the active status of users
    //modal names (target): #disable-modal : #enable-modal
    $('#entities-list-table').on('click', '[data-action="toggleUserActive"]', function(){
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');
        let target = $(this).attr('data-target');
        
        $(target + ' [name="id"]').val(id);
        $(target + ' [data-container="name"]').html(name);
    });
    
    /**
     * Sending action over jQuery
     */
    //Disable active status of User
    $('#disable-modal').on('submit', function(e){
        e.preventDefault();

        $(this).modal('hide');

        $.ajax({
            "url":$(this).attr('action'),
            "type":"post",
            "data":$(this).serialize()
        }).done(function(response){
            toastr.info(response.system_message);
            entitiesDataTable.ajax.reload(null,false);
        }).fail(function(error){
            toastr.error(error.responseJSON.system_error);
        });
    });
    //Enable active status of User
    $('#enable-modal').on('submit', function(e){
        e.preventDefault();
        
        $(this).modal('hide');
        
        $.ajax({
            "url":$(this).attr('action'),
            "type":"post",
            "data":$(this).serialize()
        }).done(function(response){
            toastr.success(response.system_message);
            entitiesDataTable.ajax.reload(null,false);
        }).fail(function(error){
            toastr.error(error.responseJSON.system_error);
        })
    });
    //Delete User
    $('#delete-modal').on('submit',function(e){
       e.preventDefault();
       $(this).modal('hide');
       
       $.ajax({
           "url":$(this).attr('action'),
           "type":"post",
           "data":$(this).serialize()
       }).done(function(response){
           toastr.success(response.system_message);
           entitiesDataTable.ajax.reload(null,false);
       }).fail(function(error){
           toastr.error(error.responseJSON.system_error);
       })
    });


</script>

@endpush