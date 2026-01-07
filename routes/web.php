<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

// Public Shop Routes
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/cart', [ShopController::class, 'cart'])->name('shop.cart');
Route::post('/cart/add', [ShopController::class, 'addToCart'])->name('shop.addToCart');
Route::put('/cart/update/{id}', [ShopController::class, 'updateCart'])->name('shop.updateCart');
Route::delete('/cart/remove/{id}', [ShopController::class, 'removeFromCart'])->name('shop.removeFromCart');
Route::get('/checkout', [ShopController::class, 'checkout'])->name('shop.checkout');
Route::post('/checkout/process', [ShopController::class, 'processCheckout'])->name('shop.processCheckout');
Route::get('/success/{id}', [ShopController::class, 'success'])->name('shop.success');

// Admin Auth Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Routes (Protected)
Route::middleware(['admin.auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('suppliers', SupplierController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
    
    Route::get('/transactions', [TransactionController::class, 'adminIndex'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'adminShow'])->name('transactions.show');
});