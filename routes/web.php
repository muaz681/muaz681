<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;

// Frontend Route part start
Route::get('/', [FrontendController::class, 'index']);
Route::get('/contact', [FrontendController::class, 'contact']);
Route::post('/contact/submit', [FrontendController::class, 'contactsubmit']);
Route::get('/productdetails/{product_id}/{product_slug}', [FrontendController::class, 'productdetails']);

// Frontend Route part end
// fontend in backend start
Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->get('/contact/insert', [ContactController::class, 'index'])->name('contactinsert');
Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->get('/contact/download/{file_name}', [ContactController::class, 'contactdownload'])->name('contactdownload');
Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->get('/banner', [BannerController::class, 'index'])->name('bannerslider');
Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->post('/banner/insert', [BannerController::class, 'bannerinsert'])->name('bannerinsert');
// fontend in backend end

// Product Route section Start
Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->get('/product', [ProductController::class, 'product']);
Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->post('/product/insert', [ProductController::class, 'productinsert']);
Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->get('/product/delete/{product_id}', [ProductController::class, 'productdelete']);
Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->get('/product/edit/{product_id}', [ProductController::class, 'productedit']);
Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->post('/product/edited', [ProductController::class, 'productedited']);
Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->get('/product/restore/{product_id}', [ProductController::class, 'productrestore']);
Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->get('/product/force/delete/{product_id}', [ProductController::class, 'producttrashed']);
// Product Route section End
// Category Route section Start
Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->resource('category', CategoryController::class);
// Category Route section End
// register route start
// Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->post('/register/admin', [RegisterController::class, 'index'])->name('registeradmin');
// register route end
Route::middleware(['auth:sanctum', 'verified', 'checkrole'])->get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
// customer dashboard route
Route::middleware(['auth:sanctum', 'verified'])->get('/customer/dashboard', [CustomerController::class, 'index']);
// Add to cart Route start
Route::post('/add/cart', [CartController::class, 'index'])->name('addcart');
Route::get('/cart/edit', [CartController::class, 'cartedit'])->name('cartedit');
Route::get('/cart/remove/{cart_id}', [CartController::class, 'cartdelete'])->name('cartdelete');
Route::post('/cart/update', [CartController::class, 'cartupdate'])->name('cartupdate');
// Add to cart Route end
// Coupon Route Start
Route::get('/coupon/add', [CouponController::class, 'index'])->name('couponadd');
Route::post('/coupon/insert', [CouponController::class, 'couponinsert'])->name('couponinsert');
// Coupon Route End
