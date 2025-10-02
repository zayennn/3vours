<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->group(function () {
    Route::get('/home', [DashboardController::class, 'home'])->name('dashboard.home');
    Route::get('/products', [DashboardController::class, 'products'])->name('dashboard.products');
    Route::get('/sales', [DashboardController::class, 'sales'])->name('dashboard.sales');
});