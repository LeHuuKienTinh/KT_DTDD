<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;


//Login Register Logout Token
Route::post('/kt-be/login', [UserController::class , 'login']);
Route::post('/kt-be/register', [UserController::class , 'register']);
Route::post('/kt-be/token/check-login', [UserController::class, 'checkLogin']);
Route::middleware('auth:sanctum')->post('/kt-be/logout', [UserController::class, 'logout']);


//Profile
Route::middleware('auth:sanctum')->get('/kt-be/get_info', [UserController::class, 'dataUser']);
Route::middleware('auth:sanctum')->post('/kt-be/update_info_user', [UserController::class, 'updateUserInfo']);

//Users
Route::get('/kt-be/get_users', [UserController::class, 'getData']);
Route::delete('/kt-be/delete_user/{id}', [UserController::class, 'destroyUser']);
Route::put('/kt-be/update_user', [UserController::class, 'updateUser']);
Route::put('/kt-be/change_status_lock', [UserController::class, 'changeLock']);
//Search User
Route::get('/kt-be/search_user', [UserController::class, 'searchUser']);
//Category
Route::get('/kt-be/get_category', [CategoryController::class, 'getData']);

//Products
Route::get('/kt-be/get_product', [ProductController::class, 'getData']);
Route::get('/kt-be/get_product_detail/{id}', [ProductController::class, 'getDataDetail']);
Route::delete('/kt-be/delete_product/{id}', [ProductController::class, 'destroyProduct']);
Route::put('/kt-be/update_product', [ProductController::class, 'updateProduct']);
Route::post('/kt-be/create_product', [ProductController::class, 'createProduct']);
//Search Product
Route::get('/kt-be/search_product', [ProductController::class, 'searchProduct']);
//Cart
Route::middleware('auth:sanctum')->post('/kt-be/add-to-cart', [CartController::class, 'addToCart']);
Route::middleware('auth:sanctum')->get('/kt-be/get-info-cart', [CartController::class, 'getData']);
Route::middleware('auth:sanctum')->delete('/kt-be/delete-product-cart/{id}', [CartController::class, 'destroyProductCart']);
Route::middleware('auth:sanctum')->post('/kt-be/update-quantity', [CartController::class, 'updateQuantity']);

//ADDRESS
Route::middleware('auth:sanctum')->get('/kt-be/get-data-address', [AddressController::class, 'getData']);
Route::middleware('auth:sanctum')->post('/kt-be/create-address', [AddressController::class, 'createAddress']);
Route::middleware('auth:sanctum')->post('/kt-be/update-default-address', [AddressController::class, 'updateDefault']);

//Payment
Route::middleware('auth:sanctum')->post('/kt-be/create-payment', [PaymentController::class, 'createPayment']);


// Route xác thực email
Route::get('verify-email/{token}', [VerificationController::class, 'verifyEmail'])->name('verify.email');

