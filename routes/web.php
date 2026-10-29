<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AdminController;

Route::get('/', [StoreController::class, 'home'])->name('home');
Route::post('/checkout', [StoreController::class, 'checkout'])->middleware('throttle:10,1')->name('checkout');
Route::get('/order/{order:token}', [StoreController::class, 'order'])->name('order.show');
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('login');
Route::post('/admin/login', [AdminController::class, 'login'])->middleware('throttle:5,1')->name('login.submit');
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'productForm'])->name('product.create');
    Route::get('/products/{product}/edit', [AdminController::class, 'productForm'])->name('product.edit');
    Route::post('/products', [AdminController::class, 'saveProduct'])->name('product.store');
    Route::put('/products/{product}', [AdminController::class, 'saveProduct'])->name('product.update');
    Route::delete('/products/{product}', [AdminController::class, 'deleteProduct'])->name('product.delete');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::patch('/orders/{order}', [AdminController::class, 'updateOrder'])->name('orders.update');
    Route::get('/finance', [AdminController::class, 'finance'])->name('finance');
    Route::post('/expenses', [AdminController::class, 'expense'])->name('expenses.store');
    Route::delete('/expenses/{expense}', [AdminController::class, 'deleteExpense'])->name('expenses.delete');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
});
