@extends('admin._layout.layout')
@section('seo_title' ,__('Products'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Products')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Products')</li>
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
                        <h3 class="card-title">@lang('Search Products')</h3>
                        <div class="card-tools">
                            <a href="{{route('admin.products.add')}}" class="btn btn-success">
                                <i class="fas fa-plus-square"></i>
                                @lang('Add new Product')
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="entities-filter-form">
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label>@lang('Name')</label>
                                    <input name="name" type="text" class="form-control" placeholder="Search by name">
                                </div>
                                <div class="col-md-2 form-group">
                                    <label>@lang('Brand')</label>
                                    <select class="form-control" name="brand_id">
                                        <option value="">--@lang('Choose Brand') --</option>
                                        @foreach(
                                        \App\Models\Brand::query()->orderBy('name')->get() as $brand
                                        )
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="product_category_id">
                                        <option value="">--@lang('Choose Category') --</option>
                                        @foreach(
                                        \App\Models\ProductCategory::orderBy('priority')->get() as $productCategory
                                        )
                                        <option value="{{$productCategory->id}}">{{$productCategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 form-group">
                                    <label>@lang('On Index')</label>
                                    <select class="form-control" name="featured">
                                        <option value="">-- @lang('All') --</option>
                                        <option value="1">yes</option>
                                        <option value="0">no</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>In size</label>
                                    <select class="form-control" multiple name="size_ids">
                                        @foreach(
                                        \App\Models\Size::orderBy('name')->get() as $size
                                        )
                                        <option value="{{$size->id}}">{{$size->name}}</option>
                                        @endforeach
                                    </select>
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
                        <h3 class="card-title">@lang('All Products')</h3>
                        <div class="card-tools">
                            
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered" id="entities-list-table">
                            <thead>                  
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 10px">@lang('Featured')</th>
                                    <th class="text-center">@lang('Photo')</th>
                                    <th style="width: 20%;">@lang('Name')</th>
                                    <th>@lang('Brand')</th>
                                    <th>@lang('Category')</th>
                                    <th class="text-center">@lang('Sizes')</th>
                                    <th class="text-center">@lang('Created At')</th>
                                    <th class="text-center">@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody><?php /*
  @if(!empty($products->count()))
  @foreach($products as $product)
  <tr>
  <td>#{{$product->id}}</td>
  <td class="text-center">
  @if($product->featured == 1)
  <span class="text-success">@lang('yes')</span>
  @elseif($product->featured == 0)
  <span class="text-danger">@lang('no')</span>
  @endif
  </td>
  <td class="text-center">
  <img
  src="{{$product->getPhotoUrl()}}"
  style="max-width: 80px;"
  >
  </td>
  <td>
  <strong>{{$product->name}}</strong>
  </td>
  <td>
  {{optional($product->brand)->name}}
  </td>
  <td>
  {{optional($product->productCategory)->name}}
  </td>
  <td>
  {{optional($product->sizes)->pluck('name')->join(', ')}}
  </td>
  <td class="text-center">{{$product->created_at}}</td>
  <td class="text-center">
  <div class="btn-group">
  <a href="{{$product->getFrontUrl()}}" class="btn btn-info" target="_blank">
  <i class="fas fa-eye"></i>
  </a>
  <a href="{{route('admin.products.edit',['product'=>$product->id])}}"
  class="btn btn-info"
  >
  <i class="fas fa-edit"></i>
  </a>
  <button type="button"
  class="btn btn-info"
  data-toggle="modal"
  data-target="{{($product->featured) ? '#disable-modal' : '#enable-modal'}}"

  data-action="toggleFeatured"
  data-id="{{$product->id}}"
  data-name="{{$product->name}}"
  >
  <i class="fas fa-{{($product->featured) ? 'minus':'check'}}"></i>
  </button>
  <button type="button"
  class="btn btn-info"
  data-toggle="modal"
  data-target="#delete-modal"

  data-action="delete"
  data-id="{{$product->id}}"
  data-name="{{$product->name}}"
  >
  <i class="fas fa-trash"></i>
  </button>
  </div>
  </td>
  </tr>
  @endforeach
  @endif
 */ ?>
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

<form action="{{route('admin.products.delete')}}" method="POST" class="modal fade" id="delete-modal">
    @csrf
    <input type="hidden" name="id" value="">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('Delete Product')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>@lang('Are you sure you want to delete product')?</p>
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

<!-- /.modal -->
<form action="{{route('admin.products.featured')}}" method="POST" class="modal fade" id="disable-modal">
    @csrf
    <input type="hidden" name="id" value="">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('Remove Product From Featured')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>@lang('Are you sure you want to remove product from featured')?</p>
                <strong data-container="name"></strong>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Cancel')</button>
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-minus-circle"></i>
                    @lang('Remove From Featured')
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>
<!-- /.modal -->

<form action="{{route('admin.products.featured')}}" method="POST" class="modal fade" id="enable-modal">
    @csrf
    <input type="hidden" name="id" value="">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('Mark Product Featured')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>@lang('Are you sure you want to mark product as featured')?</p>
                <strong data-container="name"></strong>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Cancel')</button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check"></i>
                    @lang('Mark As Featured')
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>
<!-- /.modal -->
@endsection

@push('footer_javascript')

<script type="text/javascript">
    $('#entities-filter-form [name="brand_id"]').select2({"theme":"bootstrap4"});
    $('#entities-filter-form [name="product_category_id"]').select2({"theme":"bootstrap4"});
    $('#entities-filter-form [name="size_ids"]').select2({"theme":"bootstrap4"});
     
    $('#entities-filter-form [name]').on('change keyup',function(e){
        $('#entities-filter-form').trigger('submit');
    });
    $('#entities-filter-form').on('submit', function(e){
        e.preventDefault();
        
        entitiesDataTable.ajax.reload(null, false);
    });

    let entitiesDataTable = $('#entities-list-table').DataTable({
        "serverSide": true,
        "processing": true,
        "ajax": {
            "url": "{{route('admin.products.datatable')}}",
            "type": "post",
            "data": function(dtData){//dtData parametri
                dtData["_token"] = "{{csrf_token()}}";
                        
                dtData["name"] = $('#entities-filter-form [name="name"]').val();
                dtData["product_category_id"] = $('#entities-filter-form [name="product_category_id"]').val();
                dtData["brand_id"] = $('#entities-filter-form [name="brand_id"]').val();
                dtData["featured"] = $('#entities-filter-form [name="featured"]').val();
                dtData["size_ids"] = $('#entities-filter-form [name="size_ids"]').val();
                
                //$('#entities-filter-form').serialize();// => string name=aaa&brand_id=3&..
            }
        },
        "order": [[7, 'desc']],
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50, 100, 250, 500, 1000],
        "columns": [
            {"name": "id", "data": "id"},
            {"name": "featured", "data": "featured"},
            {"name": "photo1", "data": "photo1", "orderable": false, "searchable": false, "className": "text-center"},
            {"name": "name", "data": "name"},
            {"name": "brand_name", "data": "brand_name"},
            {"name": "product_category_name", "data": "product_category_name"},
            {"name": "sizes", "orderable": false, "data": "sizes"},
            {"name": "created_at", "data": "created_at", "className": "text-center"},
            {"name": "actions", "data": "actions", "orderable": false, "searchable": false, "className": "text-center"},
        ]
    });

    $('#entities-list-table').on('click', '[data-action="delete"]', function (e) {

        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');

        $('#delete-modal [name="id"]').val(id);
        $('#delete-modal [data-container="name"]').html(name);

    });

    $('#entities-list-table').on('click', '[data-action="toggleFeatured"]', function (e) {

        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');
        let target = $(this).attr('data-target');

        $(target + ' [name="id"]').val(id);
        $(target + ' [data-container="name"]').html(name);

    });

    $('#delete-modal').on('submit', function (e) {
        e.preventDefault();

        $(this).modal('hide');

        $.ajax({
            "url": $(this).attr('action'), //citanje action attr sa forme
            "type": "post",
            "data": $(this).serialize()//citanje svih polja sa formi , name atribut
        }).done(function (response) {
            toastr.success(response.system_message);
            //refresh data tables
            entitiesDataTable.ajax.reload(null, false);// false => ne resetuje paginacija

        }).fail(function () {
            toastr.error("@lang('Error occured while deleting product')");
        });
    });
    
    $('#disable-modal').on('submit', function(e){
       e.preventDefault();
       
       $(this).modal('hide');
       
       $.ajax({
           "url":$(this).attr('action'),
           "type":"post",
           "data":$(this).serialize()
       }).done(function(response){
           toastr.error(response.system_message);
           entitiesDataTable.ajax.reload(null,false);
       }).fail(function(){
           toastr.error("@lang('Error while disabling featured field for the product')");
       });
       
    });
    
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
        }).fail(function(){
            toastr.error("@lang('Error while enabling featured field for the product')");
        })
    })
    

</script>
@endpush