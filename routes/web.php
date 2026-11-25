<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;

Route::resource('customers', CustomerController::class)
    ->except(['show']);
    
Route::resource('sales', SaleController::class)
    ->only(['index', 'create', 'store']);

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

