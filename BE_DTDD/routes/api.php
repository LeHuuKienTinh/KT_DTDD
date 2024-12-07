<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Login Register Logout Token
Route::post('/kt-be/login', [UserController::class , 'login']);
Route::post('/kt-be/register', [UserController::class , 'register']);
Route::post('/kt-be/token/check-login', [UserController::class, 'checkLogin']);
Route::middleware('auth:sanctum')->post('/kt-be/logout', [UserController::class, 'logout']);


//Profile Update Profile
Route::middleware('auth:sanctum')->get('/kt-be/get_info', [UserController::class, 'dataUser']);
Route::middleware('auth:sanctum')->post('/kt-be/update_info_user', [UserController::class, 'updateUser']);

//Category
Route::get('/kt-be/get_category', [CategoryController::class, 'getData']);

//Products
Route::get('/kt-be/get_product', [ProductController::class, 'getData']);
Route::get('/kt-be/get_product_detail/{id}', [ProductController::class, 'getDataDetail']);
