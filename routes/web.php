<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\CustomerRegistration;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//Home Controller
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/logout', [HomeController::class, 'user_logout'])->name('user.logout');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/payment', [HomeController::class, 'payment'])->name('payment');
Route::post('/payment/method', [HomeController::class, 'payment_method'])->name('payment.method');
Route::get('/order_placed', [HomeController::class, 'order_placed'])->name('order_placed');

//Front-end Controller
Route::get('/product/{slug}',[FrontendController::class, 'product_detailes'])->name('product.detailes');

//User Controller
Route::get('/user/list',[UserController::class, 'user_list'])->name('user.list');

//User Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/user/profile',[ProfileController::class, 'user_profile'])->name('user.profile');
Route::get('/user/profile/update/{id}',[ProfileController::class, 'user_profile_update'])->name('user.profile.update');
Route::post('/user/profile/update/post/{id}',[ProfileController::class, 'user_profile_update_post'])->name('user.profile.update.post');

//Category
Route::get('/category',[CategoryController::class, 'category'])->name('category');
Route::post('/category/store',[CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/delete/{id}',[CategoryController::class, 'category_delete'])->name('category.delete');

// Sub-Category
Route::get('/sub-category', [SubCategoryController::class, 'sub_category'])->name('sub-category');
Route::post('/sub-category/insert', [SubCategoryController::class, 'sub_category_insert'])->name('sub_category.insert');
Route::post('/sub-category/update/{id}', [SubCategoryController::class, 'sub_category_update'])->name('sub_category.update');
Route::get('/sub-category/delete/{id}', [SubCategoryController::class, 'sub_category_delete'])->name('sub_category.delete');

//Tags
Route::get('/tags',[TagController::class, 'tags'])->name('tag.list');
Route::post('/product/tags/insert',[TagController::class, 'tags_insert'])->name('insert.tag');
Route::get('/product/tags/delete/{id}',[TagController::class, 'tags_delete'])->name('tag.delete');

//Brand
Route::get('/brand', [BrandController::class, 'brand'])->name('brand');
Route::post('/brand/insert', [BrandController::class, 'brand_insert'])->name('insert.brand');
Route::get('/brand/delete/{id}', [BrandController::class, 'brand_delete'])->name('delete.brand');

//Products
Route::get('/products/store',[ProductController::class, 'product_store'])->name('product.store');
Route::post('/products/getsubcategory',[ProductController::class, 'getsubcategory']);
Route::post('/products/insert',[ProductController::class, 'product_insert'])->name('product.insert');
Route::get('/products/list',[ProductController::class, 'product_list'])->name('product.list');
Route::get('/products/view/{id}',[ProductController::class, 'product_view'])->name('product.view');
Route::get('/products/delete/{id}',[ProductController::class, 'product_delete'])->name('delete.product');
Route::post('/products/show',[ProductController::class, 'product_show'])->name('show.product');
Route::post('/product/get_size',[ProductController::class, 'get_size']);
Route::post('/product/get_material',[ProductController::class, 'get_material']);
Route::post('/product/get_price',[ProductController::class, 'get_price']);
Route::post('/product/pick_color',[ProductController::class, 'pick_color']);
Route::post('/product/pick_size',[ProductController::class, 'pick_size']);
Route::post('/product/pick_material',[ProductController::class, 'pick_material']);

//Variation & Inventory
Route::get('/variation',[InventoryController::class, 'variation'])->name('variation');
Route::post('/variation/color/add',[InventoryController::class, 'add_color'])->name('add.color');
Route::post('/variation/material/add',[InventoryController::class, 'add_material'])->name('add.material');
Route::post('/variation/size/add',[InventoryController::class, 'add_size'])->name('add.size');
Route::get('/variation/color/delete/{id}',[InventoryController::class, 'delete_color'])->name('delete.color');
Route::get('/variation/size/delete/{id}',[InventoryController::class, 'delete_size'])->name('delete.size');
Route::get('/variation/material/delete/{id}',[InventoryController::class, 'delete_material'])->name('delete.material');

//Inventory
Route::get('/products/inventory/{id}',[InventoryController::class, 'inventory'])->name('inventory');
Route::post('/products/inventory/add',[InventoryController::class,'add_inventory'])->name('add.inventory');
Route::get('/products/inventory/delete/{id}',[InventoryController::class, 'inventory_delete'])->name('inventory.delete');

//Cart Controller
Route::post('/product/cart/{id}',[CartController::class, 'add_to_cart'])->name('add.to.cart');
Route::get('/customer/cart/{id}',[CartController::class, 'cart'])->name('cart');
Route::get('/customer/cart/delete/{id}',[CartController::class, 'cart_delete'])->name('cart.delete');
Route::post('/customer/cart/update/{id}',[CartController::class, 'cart_update'])->name('cart.update');

//Customer Registration
Route::get('/customer/registration',[CustomerRegistration::class, 'customer_registration'])->name('customer.registration');
Route::post('/customer/registration/store',[CustomerRegistration::class, 'registration_store'])->name('register.store');
Route::get('/customer/login',[CustomerRegistration::class, 'customer_login'])->name('customer.login');
Route::post('/customer/login/post',[CustomerRegistration::class, 'customer_login_post'])->name('customer.login.post');
Route::get('/customer/logout',[CustomerRegistration::class, 'customer_logout'])->name('customer.logout');

//Coupon
Route::get('/coupon',[CouponController::class, 'coupon'])->name('coupon');
Route::post('/coupon/store' , [CouponController::class, 'coupon_store'])->name('coupon.store');
Route::get('/coupon/delete/{id}' , [CouponController::class, 'coupon_delete'])->name('delete.coupon');

//Checkout
Route::get('/checkout/{id}',[CheckoutController::class,'checkout'])->name('checkout');
Route::post('/checkout/billing',[CheckoutController::class,'billing'])->name('billing');
Route::post('/checkout/get_cities',[CheckoutController::class,'get_cities']);

//StripePayment
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

// SSLCOMMERZ Start

Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//CustomerProfile
Route::get('/customer/profile', [CustomerProfileController::class , 'customer_profile'])->name('customer.profile');
Route::post('/customer/profile/update', [CustomerProfileController::class , 'customer_profile_update'])->name('update.customer.profile');
Route::get('/customer/profile/edit', [CustomerProfileController::class , 'customer_profile_edit'])->name('customer.profile.edit');




require __DIR__.'/auth.php';
