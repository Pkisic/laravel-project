<!--Shopping Cart -->
<div class="cart-area" id="shopping_cart_top">
    
</div>
@push('footer_javascript')
<script type="text/javascript">
    
    function shoppingCartFrontRefreshTop() {
        $.ajax({//vraca promise
            "url": "{{route('front.shopping_cart.content')}}",
            "type": "get", //http method GET ili POST
            "data": {}
        }).done(function (response) {

            $('#shopping_cart_top').html(response);

            console.log('Zavrseno ucitavanje sadrzaja korpe');
            //    console.log(response);

        }).fail(function (jqXHR, textStatus, error) {
            console.log('Greska prilikom ucitavanja sadrzaja korpe');
            console.log(textStatus);
            console.log(error);

        });
    }
    
    function shoppingCartFrontRefreshTable() {
        if($('#shopping_cart_table').length <= 0){
            return;
        }
        
        $.ajax({//vraca promise
            "url": "{{route('front.shopping_cart.table')}}",
            "type": "get",
            "data": {}
        }).done(function (response) {

            $('#shopping_cart_table').html(response);

            console.log('Zavrseno ucitavanje sadrzaja tabele');
            //    console.log(response);

        }).fail(function (jqXHR, textStatus, error) {
            console.log('Greska prilikom ucitavanja sadrzaja tabele');
            console.log(textStatus);
            console.log(error);

        });
    }
    
    function shoppingCartFrontAddToCart(productId, quantity){
       $.ajax({
            "url": "{{route('front.shopping_cart.add_product')}}",
            "type": "POST",
            "data": {
                "_token": "{{csrf_token()}}", //obavezan u Laravelu
                "product_id": productId,
                "quantity": quantity
            }
        }).always(function(){
            $('#shopping_cart_top').fadeToggle();
        }).done(function (response) {
            console.log(response);
            toastr.success(response.system_message);
            shoppingCartFrontRefreshTop();
            shoppingCartFrontRefreshTable();
        }).fail(function () {
            console.log('Neuspesno dodavanje u korpu');
            toastr.error('Unable to add product to cart');
        }).always(function(){
            $('#shopping_cart_top').fadeToggle();
        }); 
    }
    
    function shoppingCartFrontChangeQuantity(productId, quantity){
       $.ajax({
            "url": "{{route('front.shopping_cart.change_quantity')}}",
            "type": "POST",
            "data": {
                "_token": "{{csrf_token()}}", //obavezan u Laravelu
                "product_id": productId,
                "quantity": quantity
            }
        }).always(function(){
            $('#shopping_cart_top').fadeToggle();
        }).done(function (response) {
            console.log(response);
            toastr.success(response.system_message);
            shoppingCartFrontRefreshTop();
            shoppingCartFrontRefreshTable();
        }).fail(function () {
            console.log('Neuspesno dodavanje u korpu');
            toastr.error('Unable to change quantity');
        }).always(function(){
            $('#shopping_cart_top').fadeToggle();
        }); 
    }
    
    function shoppingCartFrontRemoveProduct(productId)
    {
        $.ajax({
            "url":"{{route('front.shopping_cart.remove_product')}}",
            "type":"POST",
            "data":{
                "_token":"{{csrf_token()}}",
                "product_id":productId,
            }
            
        }).done(function (response){
            
            toastr.success(response.system_message);
            
            shoppingCartFrontRefreshTop();
            shoppingCartFrontRefreshTable();
            
        }).fail(function(){
            console.log('Neuspesno brisanje iz korpe');
            toastr.error('Unable to remove product from cart');
        });
    }



//    console.log('Zavrseno izvrsavanje AJAX fje');

//selektujem sve elemente koji imaju data-action='add_to_cart'
    $('[data-action="add_to_cart"]').on('click', function (e) {

        e.preventDefault();
        e.stopPropagation();

        let productId = $(this).attr('data-product-id');// || nacin let productId = $(this).data('product_id');

        let quantity = $(this).attr('data-quantity');

        shoppingCartFrontAddToCart(productId, quantity);
        

    });
    
    $('#shopping_cart_top').on('click','[data-action="remove_product"]',function(e){
        e.preventDefault();
        e.stopPropagation();
        let productId = $(this).attr('data-product-id');
        
        shoppingCartFrontRemoveProduct(productId);
        
    });
    
    $('#shopping_cart_table').on('click','[data-action="remove_product"]',function(e){
        e.preventDefault();
        e.stopPropagation();
        let productId = $(this).attr('data-product-id');
        
        shoppingCartFrontRemoveProduct(productId);
        
    });
    
    $('#shopping_cart_table').on('change', '[data-action="change_quantity"]', function(e){
        e.stopPropagation();
        
        let productId = $(this).attr('data-product-id');
        let quantity = $(this).val();
        
        shoppingCartFrontChangeQuantity(productId,quantity);
//        alert('Product : ' + productId + "  " + quantity);
        
    });
    
    shoppingCartFrontRefreshTop();
    shoppingCartFrontRefreshTable();

</script>
@endpush