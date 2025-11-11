<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CashierController;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('admin-dashboard', [AdminController::class, 'index'])->name("admin.dashboard");
    Route::get('cashier-dashboard', [CashierController::class, 'index'])->name("cashier.dashboard");
    Route::get('list-products', [AdminController::class, 'getListProduct'])->name('admin.list-products');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
