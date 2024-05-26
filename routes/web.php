<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FlowersController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionsController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware(Authenticate::class);

Route::prefix('auth')->group(function(){
    Route::get('/login', [AuthController::class, 'loginPage'])->name('auth.loginPage');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::prefix('users')->middleware(['authenticate', 'checkrole'])->group(function(){
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::get('/create', [UsersController::class, 'create'])->name('users.create');
    Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');

    Route::post('/store', [UsersController::class, 'store'])->name('users.store');
    Route::put('/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
});


Route::prefix('customers')->middleware(['authenticate'])->group(function(){
    Route::get('/', [CustomersController::class, 'index'])->name('customers.index');
    Route::get('/create', [CustomersController::class, 'create'])->name('customers.create');
    Route::get('/edit/{id}', [CustomersController::class, 'edit'])->name('customers.edit');

    Route::post('/store', [CustomersController::class, 'store'])->name('customers.store');
    Route::put('/{id}', [CustomersController::class, 'update'])->name('customers.update');
    Route::delete('/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');
});

Route::prefix('flowers')->middleware(['authenticate'])->group(function(){
    Route::get('/', [FlowersController::class, 'index'])->name('flowers.index');
    Route::get('/create', [FlowersController::class, 'create'])->name('flowers.create');
    Route::get('/edit/{id}', [FlowersController::class, 'edit'])->name('flowers.edit');

    Route::post('/store', [FlowersController::class, 'store'])->name('flowers.store');
    Route::put('/{id}', [FlowersController::class, 'update'])->name('flowers.update');
    Route::delete('/{id}', [FlowersController::class, 'destroy'])->name('flowers.destroy');
});

Route::prefix('transactions')->middleware(['authenticate'])->group(function(){
    Route::get('/sales', [TransactionsController::class, 'create'])->name('transactions.create');
    Route::post('/sales/store', [TransactionsController::class, 'store'])->name('transactions.store');
    Route::get('/history', [TransactionsController::class, 'index'])->name('transactions.index');
});
