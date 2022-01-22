<!-- Single Product -->
<div class="single-product-area">
    <div class="product_image">
        <!-- Product Image -->
        <img class="normal_img" src="{{url('/themes/front/img/product-img/new-1-back.png')}}" alt="">
        <img class="hover_img" src="{{url('/themes/front/img/product-img/new-1.png')}}" alt="">
        <!-- Product Badge -->
        <div class="product_badge">
            <span>@lang('New')</span>
        </div>
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

        <p class="brand_name">{{optional($product->brand)->name}}</p>
        <a href="{{$product->getFrontUrl()}}">{{$product->name}}</a>
        <h6 class="product-price">${{$product->price}}</h6>
    </div>
</div>