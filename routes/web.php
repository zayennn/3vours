<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;

Route::get('/', [AuthController::class, 'index'])->name('index');
Route::post('/', [AuthController::class, 'login'])->name('index.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('LoginCheck')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {

        // Home
        Route::get('/home', [DashboardController::class, 'index'])->name('home');

        // Products
        Route::get('/products', [ProductsController::class, 'index'])->name('products');
        // crud product
        Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
        Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');
        Route::get('/products/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [ProductsController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');

        // Sales
        Route::get('/sales', [SalesController::class, 'index'])->name('sales');
    });
});
