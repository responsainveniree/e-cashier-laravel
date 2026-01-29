<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CashierController;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('admin-dashboard', [AdminController::class, 'index'])->name("admin.dashboard");
    Route::get('cashier-dashboard', [CashierController::class, 'index'])->name("cashier.dashboard");
    Route::get('list-products', [AdminController::class, 'getListProduct'])->name('admin.list-products');
    Route::post('post-product', [AdminController::class, 'sendProductData'])->name('admin.post-product');
    Route::patch('edit-product', [AdminController::class, 'editProductData'])->name('admin.edit-product');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
