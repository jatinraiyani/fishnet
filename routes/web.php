<?php

use Illuminate\Support\Facades\Route;

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

// FRONT 

// Route::get('/', function () {
//     return view('home');
// });

Route::get('signup',[App\Http\Controllers\Front\AuthController::class,'signup'])->name('signup');
Route::post('do-register',[App\Http\Controllers\Front\AuthController::class,'do_register'])->name('do-register');

Route::get('signin',[App\Http\Controllers\Front\AuthController::class,'signin'])->name('signin');
Route::post('do-login',[App\Http\Controllers\Front\AuthController::class,'do_login'])->name('do-login');

Route::get('forgot',[App\Http\Controllers\Front\AuthController::class,'forgot_password'])->name('forgot');
Route::post('forgot-link',[App\Http\Controllers\Front\AuthController::class,'forgot_link'])->name('forgot-link');
Route::get('password-link/{token}/{email}',[App\Http\Controllers\Front\AuthController::class,'password_link'])->name('password-link');
Route::post('reset-password',[App\Http\Controllers\Front\AuthController::class,'reset_password'])->name('reset-password');

Route::get('aboutus',[App\Http\Controllers\Front\HomeController::class,'about_us'])->name('aboutus');
Route::get('contactus',[App\Http\Controllers\Front\HomeController::class,'contact_us'])->name('contactus');
Route::post('do-contactus',[App\Http\Controllers\Front\HomeController::class,'do_contact_us'])->name('do-contactus');

Route::get('privacy-policy',[App\Http\Controllers\Front\HomeController::class,'privacy'])->name('privacy-policy');

Route::get('/',[App\Http\Controllers\Front\HomeController::class,'index'])->name('home');
Route::post('loadmore-product',[App\Http\Controllers\Front\HomeController::class,'loadmore_product'])->name('loadmore-product');

Route::get('product-detail',[App\Http\Controllers\Front\HomeController::class,'product_detail'])->name('product-detail');
Route::get('select-product',[App\Http\Controllers\Front\HomeController::class,'select_product'])->name('select-product');
Route::get('category-by-type',[App\Http\Controllers\Front\HomeController::class,'category_by_type'])->name('category-by-type');
Route::get('subcategory-by-category',[App\Http\Controllers\Front\HomeController::class,'subcategory_by_category'])->name('subcategory-by-category');
Route::get('product-by-category',[App\Http\Controllers\Front\HomeController::class,'product_by_category'])->name('product-by-category');
Route::post('product-popup',[App\Http\Controllers\Front\HomeController::class,'product_popup'])->name('product-popup');

Route::post('cart-detail',[App\Http\Controllers\Front\HomeController::class,'cart_detail'])->name('cart-detail');
Route::post('cart-qty-update',[App\Http\Controllers\Front\HomeController::class,'cart_qty_update'])->name('cart-qty-update');
Route::post('delete-cart-product',[App\Http\Controllers\Front\HomeController::class,'delete_cart_product'])->name('delete-cart-product');

Route::get('type-product/{type}',[App\Http\Controllers\Front\HomeController::class,'type_product'])->name('type-product');

Route::get('cart-detail',[App\Http\Controllers\Front\HomeController::class,'get_cart_detail'])->name('cart-detail');

Route::post('filter-product',[App\Http\Controllers\Front\HomeController::class,'filter_product'])->name('filter-product');
Route::get('profile',[App\Http\Controllers\Front\AuthController::class,'profile'])->name('profile');

// search 

Route::post('product-search',[App\Http\Controllers\Front\HomeController::class,'product_search'])->name('product-search');
Route::get('search-result',[App\Http\Controllers\Front\HomeController::class,'search_result'])->name('search-result');

// Route::get('verify', function () {
//     return view('front.verify');
// })->name('verify');

Route::get('verify/{contact}',[App\Http\Controllers\Front\AuthController::class,'verify'])->name('verify')->where('contact', '[0-9]+');
Route::post('do-verify', [App\Http\Controllers\Front\AuthController::class,'do_verify'])->name('do-verify');
Route::get('otp-resend/{contact}', [App\Http\Controllers\Front\AuthController::class,'otp_resend'])->name('resend')->where('contact', '[0-9]+');

Route::group(['middleware' => ['FrontAuth']], function () {    
    Route::get('logout',[App\Http\Controllers\Front\AuthController::class,'logout'])->name('logout');
    Route::get('profile',[App\Http\Controllers\Front\AuthController::class,'profile'])->name('profile');
    Route::post('update-profile',[App\Http\Controllers\Front\AuthController::class,'update_profile'])->name('update-profile');    
    Route::post('change-password',[App\Http\Controllers\Front\AuthController::class,'change_password'])->name('change-password'); 
    
    Route::get('checkout',[App\Http\Controllers\Front\HomeController::class,'cart_checkout'])->name('checkout');   
    Route::post('do-checkout',[App\Http\Controllers\Front\HomeController::class,'do_checkout'])->name('do-checkout');
    Route::post('slip-upload',[App\Http\Controllers\Front\HomeController::class,'slip_upload'])->name('slip-upload');
    Route::post('pay',[App\Http\Controllers\Front\HomeController::class,'pay'])->name('pay');

});


// ADMIN 

Route::get('admin', function () {
    if(Auth::user() && Gate::check('isAdmin')){
        return redirect('admin/dashboard');
    } else {
        return redirect('admin/login');
    }   
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/login', [App\Http\Controllers\Admin\AuthController::class,'admin_login'])->name('admin-login');
Route::post('admin/do-login', [App\Http\Controllers\Admin\AuthController::class,'do_login'])->name('do-login');

Route::group(['prefix' => 'admin','middleware' => ['AdminAuth']], function () {

    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('logout',[App\Http\Controllers\Admin\AuthController::class,'logout'])->name('logout');
    Route::get('edit/profile',[App\Http\Controllers\Admin\AuthController::class,'edit_profile'])->name('edit-profile');
    Route::post('update/profile',[App\Http\Controllers\Admin\AuthController::class,'update_profile'])->name('update-profile');
    Route::get('edit/password',[App\Http\Controllers\Admin\AuthController::class,'edit_password'])->name('edit-password');
    Route::post('update/password',[App\Http\Controllers\Admin\AuthController::class,'update_password'])->name('update-password');

    Route::group(['prefix' => 'type','middleware' => ['AdminAuth']], function () {

        Route::get('/',[App\Http\Controllers\Admin\TypeController::class,'index'])->name('list-type');
        Route::get('create',[App\Http\Controllers\Admin\TypeController::class,'create'])->name('type-create');
        Route::post('store',[App\Http\Controllers\Admin\TypeController::class,'store'])->name('type-store');
        Route::get('edit/{id}',[App\Http\Controllers\Admin\TypeController::class,'edit'])->name('type-edit');
        Route::post('update/{id}',[App\Http\Controllers\Admin\TypeController::class,'update'])->name('type-update');

    });

    Route::group(['prefix' => 'brand','middleware' => ['AdminAuth']], function () {

        Route::get('/',[App\Http\Controllers\Admin\BrandController::class,'index'])->name('list-brand');
        Route::get('create',[App\Http\Controllers\Admin\BrandController::class,'create'])->name('brand-create');
        Route::post('store',[App\Http\Controllers\Admin\BrandController::class,'store'])->name('brand-store');
        Route::get('edit/{id}',[App\Http\Controllers\Admin\BrandController::class,'edit'])->name('brand-edit');
        Route::post('update/{id}',[App\Http\Controllers\Admin\BrandController::class,'update'])->name('brand-update');
        Route::post('delete',[App\Http\Controllers\Admin\BrandController::class,'delete'])->name('brand-delete');

    });

    Route::group(['prefix' => 'slider','middleware' => ['AdminAuth']], function () {

        Route::get('/',[App\Http\Controllers\Admin\SliderController::class,'index'])->name('list-slider');
        Route::get('create',[App\Http\Controllers\Admin\SliderController::class,'create'])->name('slider-create');
        Route::post('store',[App\Http\Controllers\Admin\SliderController::class,'store'])->name('slider-store');
        Route::get('edit/{id}',[App\Http\Controllers\Admin\SliderController::class,'edit'])->name('slider-edit');
        Route::post('update/{id}',[App\Http\Controllers\Admin\SliderController::class,'update'])->name('slider-update');
        Route::post('delete',[App\Http\Controllers\Admin\SliderController::class,'delete'])->name('slider-delete');

    });

    Route::group(['prefix' => 'category','middleware' => ['AdminAuth']], function () {

        Route::get('/',[App\Http\Controllers\Admin\CategoryController::class,'index'])->name('list-category');
        Route::get('create',[App\Http\Controllers\Admin\CategoryController::class,'create'])->name('category-create');
        Route::post('store',[App\Http\Controllers\Admin\CategoryController::class,'store'])->name('category-store');
        Route::get('edit/{id}',[App\Http\Controllers\Admin\CategoryController::class,'edit'])->name('category-edit');
        Route::post('update/{id}',[App\Http\Controllers\Admin\CategoryController::class,'update'])->name('category-update');

    });

    Route::group(['prefix' => 'subcategory','middleware' => ['AdminAuth']], function () {

        Route::get('/',[App\Http\Controllers\Admin\SubCategoryController::class,'index'])->name('list-subcategory');
        Route::get('create',[App\Http\Controllers\Admin\SubCategoryController::class,'create'])->name('subcategory-create');
        Route::post('store',[App\Http\Controllers\Admin\SubCategoryController::class,'store'])->name('subcategory-store');
        Route::get('edit/{id}',[App\Http\Controllers\Admin\SubCategoryController::class,'edit'])->name('subcategory-edit');
        Route::post('update/{id}',[App\Http\Controllers\Admin\SubCategoryController::class,'update'])->name('subcategory-update');
        Route::post('category-by-type',[App\Http\Controllers\Admin\SubCategoryController::class,'category_by_type'])->name('category-by-type');

    });

    Route::group(['prefix' => 'product','middleware' => ['AdminAuth']], function () {

        Route::get('/',[App\Http\Controllers\Admin\ProductController::class,'index'])->name('list-product');
        Route::get('create',[App\Http\Controllers\Admin\ProductController::class,'create'])->name('product-create');
        Route::post('store',[App\Http\Controllers\Admin\ProductController::class,'store'])->name('product-store');
        Route::get('edit/{id}',[App\Http\Controllers\Admin\ProductController::class,'edit'])->name('product-edit');
        Route::post('update/{id}',[App\Http\Controllers\Admin\ProductController::class,'update'])->name('product-update');
        Route::post('delete',[App\Http\Controllers\Admin\ProductController::class,'delete'])->name('product-delete');
        Route::post('category-by-type',[App\Http\Controllers\Admin\ProductController::class,'category_by_type'])->name('category-by-type');
        Route::post('subcategory-by-category',[App\Http\Controllers\Admin\ProductController::class,'subcategory_by_category'])->name('subcategory-by-category');
        Route::post('remove-image',[App\Http\Controllers\Admin\ProductController::class,'remove_image'])->name('product-remove-image');
        Route::post('remove-product-size',[App\Http\Controllers\Admin\ProductController::class,'remove_product_size'])->name('remove-product-size');

    });

    Route::group(['prefix' => 'order','middleware' => ['AdminAuth']], function () {
        Route::get('/',[App\Http\Controllers\Admin\OrderController::class,'index'])->name('list-order');
        Route::post('change-status',[App\Http\Controllers\Admin\OrderController::class,'change_status'])->name('change-status');
        Route::get('view/{order}',[App\Http\Controllers\Admin\OrderController::class,'view_order'])->name('view-order');
    }); 

    Route::group(['prefix' => 'cms','middleware' => ['AdminAuth']], function () {

        Route::get('/',[App\Http\Controllers\Admin\CMSController::class,'index'])->name('list-cms');
        Route::post('update',[App\Http\Controllers\Admin\CMSController::class,'update_cms'])->name('update-cms');        

    }); 
    
    // Route::group(['prefix' => 'review','middleware' => ['AdminAuth']], function () {

    //     Route::get('/',[App\Http\Controllers\Admin\ReviewController::class,'index'])->name('list-review');
    //     Route::post('delete',[App\Http\Controllers\Admin\ReviewController::class,'delete'])->name('delete-review');        

    // }); 

    Route::group(['prefix' => 'contactus','middleware' => ['AdminAuth']], function () {

        Route::get('/',[App\Http\Controllers\Admin\ContactUsController::class,'index'])->name('list-contactus');
        Route::post('change-status',[App\Http\Controllers\Admin\ContactUsController::class,'change_status'])->name('change-contactus');        

    }); 

    Route::group(['prefix' => 'promobanner','middleware' => ['AdminAuth']], function () {

        Route::get('/',[App\Http\Controllers\Admin\AdBannerController::class,'index'])->name('list-promobanner');        
        Route::get('create',[App\Http\Controllers\Admin\AdBannerController::class,'create'])->name('promobanner-create');
        Route::post('store',[App\Http\Controllers\Admin\AdBannerController::class,'store'])->name('promobanner-store');
        Route::get('edit/{id}',[App\Http\Controllers\Admin\AdBannerController::class,'edit'])->name('promobanner-edit');
        Route::post('update/{id}',[App\Http\Controllers\Admin\AdBannerController::class,'update'])->name('promobanner-update');        
        Route::post('delete',[App\Http\Controllers\Admin\AdBannerController::class,'delete'])->name('promobanner-delete');
    }); 

});
