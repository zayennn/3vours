<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->group(function () {
    // home
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.home');

    // products
    Route::get('/products', [ProductsController::class, 'index'])->name('dashboard.products');

    // sales history
    Route::get('/sales', [SalesController::class, 'index'])->name('dashboard.sales');
});