<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\SizesController as AdminSizesController;
use App\Http\Controllers\Admin\BrandsController as AdminBrandsController;
use App\Http\Controllers\Admin\ProductCategoriesController as AdminProductCategoriesController;
use App\Http\Controllers\Admin\ProductsController as AdminProductsController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/',
                [IndexController::class, 'index'])
        ->name('front.index.index');

Route::get('/about-us',
                [PagesController::class, 'aboutUs'])
        ->name('front.pages.about_us');

Route::get('/terms',
                [PagesController::class, 'terms'])
        ->name('front.pages.terms');

Route::get('/products',
                [ProductsController::class, 'index'])
        ->name('front.products.index');

Route::get('/products/{product}/{seoSlug?}',
                [ProductsController::class, 'single'])
        ->name('front.products.single');

Route::get('/contact-us',
                [ContactController::class, 'index'])
        ->name('front.contact.index');

Route::post('/contact-us/send-message',
                [ContactController::class, 'sendMessage'])
        ->name('front.contact.send_message');



Route::get('/shopping-cart',
                [ShoppingCartController::class, 'index'])
        ->name('front.shopping_cart.index');

Route::get('/shopping-cart/content',
                [ShoppingCartController::class, 'content'])
        ->name('front.shopping_cart.content');

Route::get('/shopping-cart/table',
                [ShoppingCartController::class, 'table'])
        ->name('front.shopping_cart.table');

Route::post('/shopping-cart/add-product',
                [ShoppingCartController::class, 'addProduct'])
        ->name('front.shopping_cart.add_product');

Route::post('/shopping-cart/change-quantity',
                [ShoppingCartController::class, 'changeQuantity'])
        ->name('front.shopping_cart.change_quantity');

Route::post('/shopping-cart/remove-product',
                [ShoppingCartController::class, 'removeProduct'])
        ->name('front.shopping_cart.remove_product');

//CHECKOUT CONTROLLER

Route::prefix('/checkout')
        ->group(function(){
            Route::get('/',
                    [CheckoutController::class, 'index'])
                    ->name('front.checkout.index');
            
            Route::post('/confirm-order',
                    [CheckoutController::class, 'confirmOrder'])
                    ->name('front.checkout.confirm_order');
});
//orders controller    
Route::prefix('/orders')->group(function(){
    Route::get('/details/{uuid}' , 
            [OrdersController::class , 'details'])->name('front.orders.details');
});

Auth::routes();

Route::middleware('auth')
        ->prefix('/admin')
        ->group(function() {

            Route::get('/',
                    [AdminIndexController::class, 'index'])
            ->name('admin.index.index');
//Sizes Controller - CRUD Operations
            Route::prefix('/sizes')->group(function() {

                Route::get('/',
                        [AdminSizesController::class, 'index'])
                ->name('admin.sizes.index');

                Route::get('/add',
                        [AdminSizesController::class, 'add'])
                ->name('admin.sizes.add');

                Route::post('/insert',
                        [AdminSizesController::class, 'insert'])
                ->name('admin.sizes.insert');

                Route::get('/edit/{size}',
                        [AdminSizesController::class, 'edit'])
                ->name('admin.sizes.edit');

                Route::post('/update/{size}',
                        [AdminSizesController::class, 'update'])
                ->name('admin.sizes.update');

                Route::post('/delete',
                        [AdminSizesController::class, 'delete'])
                ->name('admin.sizes.delete');

                Route::post('/change-priorities',
                        [AdminSizesController::class, 'changePriorities'])
                ->name('admin.sizes.change_priorities');
            });
//Product Categories Controller - CRUD Operations
            Route::prefix('/product-categories')->group(function() {
                Route::get('/',
                        [AdminProductCategoriesController::class, 'index'])
                ->name('admin.product_categories.index');

                Route::get('/add',
                        [AdminProductCategoriesController::class, 'add'])
                ->name('admin.product_categories.add');

                Route::post('/insert',
                        [AdminProductCategoriesController::class, 'insert'])
                ->name('admin.product_categories.insert');

                Route::get('/edit/{productCategory}',
                        [AdminProductCategoriesController::class, 'edit'])
                ->name('admin.product_categories.edit');

                Route::post('/update/{productCategory}',
                        [AdminProductCategoriesController::class, 'update'])
                ->name('admin.product_categories.update');

                Route::post('/delete',
                        [AdminProductCategoriesController::class, 'delete'])
                ->name('admin.product_categories.delete');

                Route::post('/change-priorities',
                        [AdminProductCategoriesController::class, 'changePriorities'])
                ->name('admin.product_categories.change_priorities');
            });
//Brands Controller - CRUD Operations
            Route::prefix('/brands')->group(function() {

                Route::get('/',
                        [AdminBrandsController::class, 'index'])
                ->name('admin.brands.index');

                Route::get('/add',
                        [AdminBrandsController::class, 'add'])
                ->name('admin.brands.add');

                Route::post('/insert',
                        [AdminBrandsController::class, 'insert'])
                ->name('admin.brands.insert');

                Route::get('/edit/{brand}',
                        [AdminBrandsController::class, 'edit'])
                ->name('admin.brands.edit');

                Route::post('/update/{brand}',
                        [AdminBrandsController::class, 'update'])
                ->name('admin.brands.update');

                Route::post('/delete',
                        [AdminBrandsController::class, 'delete'])
                ->name('admin.brands.delete');

                Route::post('/delete-photo/{brand}',
                        [AdminBrandsController::class, 'deletePhoto'])
                ->name('admin.brands.delete_photo');
            });
            
//Products Controller - CRUD Operations
            Route::prefix('/products')->group(function() {

                Route::get('/',
                        [AdminProductsController::class, 'index'])
                ->name('admin.products.index');

                Route::get('/add',
                        [AdminProductsController::class, 'add'])
                ->name('admin.products.add');

                Route::post('/insert',
                        [AdminProductsController::class, 'insert'])
                ->name('admin.products.insert');

                Route::get('/edit/{product}',
                        [AdminProductsController::class, 'edit'])
                ->name('admin.products.edit');

                Route::post('/update/{product}',
                        [AdminProductsController::class, 'update'])
                ->name('admin.products.update');

                Route::post('/delete',
                        [AdminProductsController::class, 'delete'])
                ->name('admin.products.delete');
                
                Route::post('/delete-photo/{product}',
                        [AdminProductsController::class, 'deletePhoto'])
                ->name('admin.products.delete_photo');
                
                Route::post('/featured',
                        [AdminProductsController::class, 'toggleFeatured'])
                        ->name('admin.products.featured');
                
                Route::post('/datatable',
                        [AdminProductsController::class, 'datatable'])
                        ->name('admin.products.datatable');
            });
            
            
//Users Controller - CRUD Operations
            Route::prefix('/users')->group(function(){
                
                Route::get('/',
                        [AdminUsersController::class,'index'])
                        ->name('admin.users.index');
                
                Route::get('/add',
                        [AdminUsersController::class,'add'])
                        ->name('admin.users.add');
                
                Route::post('/insert',
                        [AdminUsersController::class,'insert'])
                        ->name('admin.users.insert');
                
                Route::get('/edit/{user}',
                        [AdminUsersController::class, 'edit'])
                ->name('admin.users.edit')
                ->missing(function(Request $request){
                    return redirect(route('admin.users.index'));
                });

                Route::post('/update/{user}',
                        [AdminUsersController::class, 'update'])
                ->name('admin.users.update')
                ->missing(function(Request $request){
                    return redirect(route('admin.users.index'));
                });
                
                Route::post('/delete',
                        [AdminUsersController::class , 'delete'])
                        ->name('admin.users.delete');
                
                Route::post('/datatable',
                        [AdminUsersController::class,'datatable'])
                        ->name('admin.users.datatable');
                
                Route::post('/isactive',
                        [AdminUsersController::class,'toggleActive'])
                        ->name('admin.users.isactive');
                
                Route::post('/delete-image/{user}',
                        [AdminUsersController::class,'deleteImage'])
                        ->name('admin.users.delete_image');
            });
//Profile Controller - CRUD Operations
            Route::prefix('/profile')->group(function(){
                
                Route::get('/edit',
                        [AdminProfileController::class, 'edit'])
                ->name('admin.profile.edit');

                Route::post('/update',
                        [AdminProfileController::class, 'update'])
                ->name('admin.profile.update');
                
                Route::post('/delete-image',
                        [AdminProfileController::class,'deleteImage'])
                        ->name('admin.profile.delete_image');
                
                Route::get('/change-password',
                        [AdminProfileController::class, 'changePassword'])
                ->name('admin.profile.change_password');
                
                Route::post('/change-password',
                        [AdminProfileController::class,'changePasswordConfirm'])
                        ->name('admin.profile.change_password_confirm');
                
            });
        });
