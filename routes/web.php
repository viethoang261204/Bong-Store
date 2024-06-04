<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminIndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserIndexController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\CartController;

Route::get('/admin',[AdminIndexController::class,"adminindex"]);

Route::get('/admin/category',[CategoryController::class,"getAll"]);
Route::post('/admin/category/save', [CategoryController::class, "save"]);
Route::get('/admin/category/delete/{id}', [CategoryController::class, "delete"]);
Route::post('/admin/category/update/{id}', [CategoryController::class, "update"]);
Route::get('/admin/category/edit/{id}', [CategoryController::class, "edit"]);
Route::get('/admin/category/search',[CategoryController::class,"search"]);

Route::get('/admin/users',[UserController::class,"getAll"]);
Route::post('/admin/users/toggle-status/{id}', [UserController::class, 'toggleStatus']);
Route::get('/admin/users/delete/{id}', [UserController::class, 'delete']);
Route::get('/admin/users/edit/{id}',[UserController::class,'edit']);
Route::post('/admin/users/update/{id}', [UserController::class, "update"]);
Route::post('/update-avatar', [UserController::class, 'updateAvatar'])->name('update-avatar');
Route::get('/admin/users/add', [UserController::class, "add"]);
Route::post('/admin/users/save', [UserController::class,"save"]);

Route::get('/admin/product',[ProductController::class,"getAll"]);
Route::get('/admin/product/delete/{id}', [ProductController::class, "delete"]);
Route::get('/admin/product/edit/{id}',[ProductController::class,"edit"]);
Route::post('/admin/product/update/{id}', [ProductController::class, "update"]);
Route::get('/admin/product/add', [ProductController::class, "add"]);
Route::post('/admin/product/save', [ProductController::class,"save"]);

Route::get('/home',[UserIndexController::class,"userindex"]);
Route::get("/product-detail/{id}", [DetailsController::class, "detailsindex"]);

Route::get("/cart", [CartController::class, "cart"]);
Route::get("/add-to-cart/{id}/{quantity}", [CartController::class, "addToCart"]);
Route::get('/cart/remove/{id}', [CartController::class, 'removeCart']);
Route::get('/cart/clear', [CartController::class, 'clearCart']);
Route::get("/cart/update/{type}/{id}/{quantity}", [CartController::class, "updateCart"]);

