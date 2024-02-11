@extends('front._layout.layout')

@section('seo_title','Products')
@section('seo_description','Search for products')

@section('content')
<!-- Breadcumb Area -->
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>Product List</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.index.index')}}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Products')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Shop List Area -->
<section class="shop_list_area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-xl-3">
                <form 
                    action="{{route('front.products.index')}}" 
                    method="get" 
                    id="products_filter_form"
                >
                <div class="shop_sidebar_area">
                    <!-- Single Widget -->
                    <div class="widget catagory mb-30">
                        <h6 class="widget-title">@lang('Product Categories')</h6>
                        <div class="widget-desc">
                            @if(!empty($productCategories->count()))
                            @foreach($productCategories as $productCategory)
                            <!-- Single Checkbox -->
                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                <input 
                                    type="checkbox"
                                    name="product_category_id[]"
                                    value="{{$productCategory->id}}"
                                    class="custom-control-input" 
                                    id="product_category_{{$productCategory->id}}"
                                    @if(
                                        isset($formData['product_category_id'])
                                        && in_array($productCategory->id , $formData['product_category_id'])
                                    )
                                    checked
                                    @endif
                                    >
                                <label 
                                    class="custom-control-label" 
                                    for="product_category_{{$productCategory->id}}"
                                    >{{$productCategory->name}} 
                                    <span class="text-muted">
                                        ({{$productCategory->products_count}})
                                    </span>
                                </label>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Single Widget -->
                    <div class="widget color mb-30">
                        <h6 class="widget-title">@lang('Filter by Size')</h6>
                        <div class="widget-desc">
                            @if(!empty($sizes->count()))
                            @foreach($sizes as $size)
                            <!-- Single Checkbox -->
                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                <input 
                                    type="checkbox" 
                                    class="custom-control-input"
                                    name="sizes_id[]"
                                    value="{{$size->id}}"
                                    id="sizes_id_{{$size->id}}"
                                    @if(
                                        isset($formData['sizes_id'])
                                        && in_array($size->id , $formData['sizes_id'])
                                    )
                                    checked
                                    @endif
                                    >
                                <label 
                                    class="custom-control-label" 
                                    for="sizes_id_{{$size->id}}"
                                    >{{$size->name}} 
                                    <span class="text-muted">
                                        ({{$size->products_count}})
                                    </span>
                                </label>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Single Widget -->
                    <div class="widget brands mb-30">
                        <h6 class="widget-title">@lang('Filter by brands')</h6>
                        <div class="widget-desc">
                            @if(!empty($brands->count()))
                            @foreach($brands as $brand)
                            <!-- Single Checkbox -->
                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                <input 
                                    type="checkbox" 
                                    class="custom-control-input" 
                                    name="brands_id[]"
                                    value="{{$brand->id}}"
                                    id="brands_id_{{$brand->id}}"
                                    @if(
                                        isset($formData['brands_id'])
                                        && in_array($brand->id , $formData['brands_id'])
                                    )
                                    checked
                                    @endif
                                    >
                                <label 
                                    class="custom-control-label" 
                                    for="brands_id_{{$brand->id}}"
                                    >{{$brand->name}} 
                                    <span class="text-muted">
                                        ({{$brand->products_count}})
                                    </span>
                                </label>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </form>
            </div>
            
            <div class="col-12 col-md-8 col-xl-9">
                <!-- Shop Top Sidebar -->
                <div class="shop_top_sidebar_area d-flex flex-wrap align-items-center justify-content-between">
                    <select class="small right">
                        <option selected>@lang('Sort by Popularity')</option>
                        <option value="1">@lang('Sort by Newest')</option>
                        <option value="2">@lang('Sort by Sales')</option>
                        <option value="3">@lang('Sort by Ratings')</option>
                    </select>
                </div>

                <div class="shop_list_product_area">
                    <div class="row">
                        @if(!empty($products->count()))
                        @foreach($products as $product)
                        <!-- Single Product -->
                        <div class="col-12">
                            <div class="single-product-area mb-30">
                                <div class="product_image">
                                    <!-- Product Image -->
                                    <img class="normal_img" src="{{$product->getPhotoUrl()}}" alt="">
                                    <img class="hover_img" src="{{$product->getPhotoUrl()}}" alt="">
                                    @if($product->featured)
                                    <!-- Product Badge -->
                                    <div class="product_badge">
                                        <span>@lang('New')</span>
                                    </div>
                                    @endif
                                </div>

                                <!-- Product Description -->
                                <div class="product_description">
                                    <!-- Add to cart -->
                                    <div class="product_add_to_cart">
                                        <a 
                                            href="#"
                                            data-action="add_to_cart"
                                            data-product-id="{{$product->id}}"
                                            data-quantity="1"
                                            >
                                            <i class="icofont-shopping-cart"></i>
                                            @lang('Add to Cart')
                                        </a>
                                    </div>

                                    <!-- Quick View -->
                                    <div class="product_quick_view">
                                        <a 
                                            href="{{$product->getFrontUrl()}}"
                                            ><i class="icofont-eye-alt"></i>
                                            @lang('View Product')
                                        </a>
                                    </div>

                                    <p class="brand_name">
                                        {{optional($product->brand)->name}}
                                    </p>
                                    <p class="brand_name">
                                        {{optional($product->productCategory)->name}}
                                    </p>
                                    <a href="{{$product->getFrontUrl()}}">{{$product->name}}</a>
                                    <h6 class="product-price">${{$product->price}}
                                        @if($product->old_price > 0)
                                        <span>${{$product->old_price}}</span>
                                        @endif
                                    </h6>
                                    <p class="product-short-desc">
                                        {{$product->description}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <h2>No products for the given parameters</h2>
                        @endif
                    </div>
                </div>

                <!-- Shop Pagination Area -->
                
                <div class="shop_pagination_area mt-30">
                    <nav aria-label="Page navigation">
                        {{$products->links()}}
                    </nav>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Shop List Area -->
@endsection
@push('footer_javascript')
<script src="{{url('themes/front/plugins/jquery.ba-throttle-debounce.min.js')}}" type="text/javascript"></script>
<script>
    
$('#products_filter_form').on('click', '.custom-checkbox', $.debounce(1000, function(e){
    e.stopPropagation();
    
    $('#products_filter_form').trigger('submit');
    
}));

</script>
@endpush
