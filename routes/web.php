<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;

Route::get('/', [AuthController::class, 'index'])->name('index');
Route::post('/', [AuthController::class, 'login'])->name('index.login');

Route::prefix('dashboard')->group(function () {
    // home
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.home');

    // products
    Route::get('/products', [ProductsController::class, 'index'])->name('dashboard.products');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('dashboard.products.create');

    // sales history
    Route::get('/sales', [SalesController::class, 'index'])->name('dashboard.sales');
});