<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=>'Api'],function (){    
    Route::post('login',[App\Http\Controllers\Api\AuthController::class,'authenticate']);
    Route::post('register',[App\Http\Controllers\Api\AuthController::class,'register']);

    Route::post('link',[App\Http\Controllers\Api\AuthController::class,'link']);
    // Route::post('reset',[App\Http\Controllers\Api\AuthController::class,'reset']);

    // Home screen
    Route::get('home',[App\Http\Controllers\Api\ProductController::class,'home']);


    // Wizard 

    Route::get('type-list',[App\Http\Controllers\Api\TypeController::class,'list']);   
    Route::get('category-list',[App\Http\Controllers\Api\TypeController::class,'category_list']);   
    Route::get('brand-list',[App\Http\Controllers\Api\TypeController::class,'brand_list']);   
    Route::post('category-by-type',[App\Http\Controllers\Api\TypeController::class,'category_by_type']);
    Route::post('subcategory-by-category',[App\Http\Controllers\Api\TypeController::class,'subcategory_by_category']);
    Route::post('product-by-subcategory',[App\Http\Controllers\Api\ProductController::class,'product_by_subcategory']);

    // product
    Route::get('product-list',[App\Http\Controllers\Api\ProductController::class,'product_list']);
    Route::post('product-by-type',[App\Http\Controllers\Api\ProductController::class,'product_by_type']);
    Route::post('product-by-category',[App\Http\Controllers\Api\ProductController::class,'product_by_category']);
    Route::post('product-detail',[App\Http\Controllers\Api\ProductController::class,'product_detail']);
    Route::post('size-chart',[App\Http\Controllers\Api\ProductController::class,'size_chart']);

    // search
    Route::post('search',[App\Http\Controllers\Api\ProductController::class,'search']);
    Route::post('filter',[App\Http\Controllers\Api\ProductController::class,'filter']);   
    
    // adbanner 

    Route::get('promo-banner',[App\Http\Controllers\Api\ProductController::class,'promo_banner']);

});

Route::group(['namespace' => 'Api','middleware'=>'ApiAuth'], function () {    

    Route::post('verify',[App\Http\Controllers\Api\AuthController::class,'contact_verify']);
    Route::post('resend-otp',[App\Http\Controllers\Api\AuthController::class,'resend_otp']);
    Route::post('change-password',[App\Http\Controllers\Api\AuthController::class,'changePassword']);
    Route::get('profile',[App\Http\Controllers\Api\AuthController::class,'profile']);
    Route::post('update-profile',[App\Http\Controllers\Api\AuthController::class,'update_profile']);
    Route::get('logout',[App\Http\Controllers\Api\AuthController::class,'logout']);

    Route::post('add-cart',[App\Http\Controllers\Api\ProductController::class,'add_cart']);
    Route::get('get-cart',[App\Http\Controllers\Api\ProductController::class,'get_cart']);
    Route::post('delete-cart-item',[App\Http\Controllers\Api\ProductController::class,'delete_cart_item']);
    Route::post('qty-update',[App\Http\Controllers\Api\ProductController::class,'qty_update']);

    Route::post('checkout',[App\Http\Controllers\Api\ProductController::class,'checkout']);
    Route::post('pay',[App\Http\Controllers\Api\ProductController::class,'pay']);
    Route::get('order-list',[App\Http\Controllers\Api\ProductController::class,'order_list']);
    Route::post('slip-upload',[App\Http\Controllers\Api\ProductController::class,'slip_upload']);

});
