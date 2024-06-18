<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminIndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserIndexController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ProductShowController;
use App\Http\Controllers\CustomerController;

Route::get('/admin',[AdminIndexController::class,"adminindex"]);

Route::get('/admin/category',[CategoryController::class,"getAll"]);
Route::post('/admin/category/save', [CategoryController::class, "save"]);
Route::get('/admin/category/delete/{id}', [CategoryController::class, "delete"]);
Route::post('/admin/category/update/{id}', [CategoryController::class, "update"]);
Route::get('/admin/category/edit/{id}', [CategoryController::class, "edit"]);
Route::get('/admin/category/search',[CategoryController::class,"search"]);

Route::get('/admin/users',[UserController::class,"getAll"]);
Route::get('/admin/users/delete/{id}', [UserController::class, 'delete']);
Route::get('/admin/users/edit/{id}',[UserController::class,'edit']);
Route::post('/admin/users/update/{id}', [UserController::class, "update"]);
Route::post('/update-avatar', [UserController::class, 'updateAvatar'])->name('update-avatar');
Route::get('/admin/users/add', [UserController::class, "add"]);
Route::post('/admin/users/save', [UserController::class,"save"]);

Route::get('/admin/customers',[CustomerController::class,"getAll"]);
Route::get('/admin/customers/delete/{id}', [CustomerController::class, 'delete']);
Route::get('/admin/customers/edit/{id}',[CustomerController::class,'edit']);
Route::post('/admin/customers/update/{id}', [CustomerController::class, "update"]);
Route::post('/update-avatar', [CustomerController::class, 'updateAvatar'])->name('update-avatar');
Route::get('/admin/customers/add', [CustomerController::class, "add"]);
Route::post('/admin/customers/save', [CustomerController::class,"save"]);

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

Route::get('/checkout', [CartController::class, "checkout"]);
Route::post('/cart/checkout', [CartController::class, "cartCheckout"]);

Route::get('/admin/order-list', [AdminOrderController::class, "getAll"]);
Route::get('/admin/order-list/{status}', [AdminOrderController::class, "filter"]);
Route::get('/admin/order-update-status/{id}/{status}', [AdminOrderController::class, "ordersUpdateStatus"]);

Route::get('/products/category/{categoryName}', [ProductShowController::class, 'showByCategory'])->name('category.show');
