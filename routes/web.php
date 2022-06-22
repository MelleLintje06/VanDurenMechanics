<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\webshop;
use App\Http\Controllers\productController;
use App\Http\Controllers\categorieController;
use App\Http\Controllers\userController;
use App\Http\Controllers\messageController;

session_start();

// WebshopController
// GET
Route::get('/', [webshop::class, 'index'])->name('home');
Route::get('/store', [webshop::class, 'store'])->name('store');
Route::get('/contact', [webshop::class, 'contact'])->name('contact');
Route::get('/dashboard', [webshop::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::get('/images', [webshop::class, 'media'])->middleware(['auth'])->name('images');


// ProductController
// GET
Route::get('/product', [productController::class, 'product_redirect'])->name('product_details');
Route::get('/product/{slug}', [productController::class, 'product'])->name('product_details');
Route::get('/products', [productController::class, 'products'])->middleware(['auth'])->name('products');
Route::get('/products/create', [productController::class, 'createproduct'])->middleware(['auth'])->name('create_products');
Route::get('/products/edit', [productController::class, 'editproduct'])->middleware(['auth'])->name('edit_products');
Route::get('/products/delete', [productController::class, 'deleteproduct'])->middleware(['auth'])->name('delete_products');
// POST
Route::post('/products', [productController::class, 'postproduct'])->middleware(['auth'])->name('post_product');
Route::post('/products/edit', [productController::class, 'updateproduct'])->middleware(['auth']);
Route::post('/product', [productController::class, 'postreview'])->name('post_review');

// CategorieController
// GET
Route::get('/categories', [categorieController::class, 'categories'])->middleware(['auth'])->name('categories');
Route::get('/categories/create', [categorieController::class, 'createcategory'])->middleware(['auth'])->name('create_cat');
Route::get('/categories/edit', [categorieController::class, 'editcategory'])->middleware(['auth'])->name('edit_cat');
Route::get('/categories/delete', [categorieController::class, 'deletecategory'])->middleware(['auth'])->name('delete_cat');
// POST
Route::post('/categories', [categorieController::class, 'postcategory'])->middleware(['auth']);
Route::post('/categories/edit', [categorieController::class, 'updatecategory'])->middleware(['auth']);

// UserController
// GET
Route::get('/users', [userController::class, 'users'])->middleware(['auth'])->name('users');

// MessageController
// GET
Route::get('/messages', [messageController::class, 'messages'])->middleware(['auth'])->name('messages');
Route::get('/message', [messageController::class, 'message'])->middleware(['auth'])->name('message');
Route::get('/message/delete', [messageController::class, 'deletemessage'])->middleware(['auth'])->name('delete_message');
// POST
Route::post('/contact', [messageController::class, 'postcontact'])->name('post_contact');
Route::post('/messages', [messageController::class, 'updatemessage'])->middleware(['auth'])->name('update_message');

require __DIR__.'/auth.php';
