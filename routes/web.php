<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FlowersController;
use App\Http\Controllers\CustomersController;

Route::get('/', function () {
    return view('dashboard');
});

Route::prefix('users')->group(function(){
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::get('/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/store', [UsersController::class, 'store'])->name('users.store');
    Route::get('/update', [UsersController::class, 'update'])->name('users.update');
});

Route::prefix('customers')->group(function(){
    Route::get('/', [CustomersController::class, 'index'])->name('customers.index');
    Route::get('/create', [CustomersController::class, 'create'])->name('customers.create');
    Route::get('/update', [CustomersController::class, 'update'])->name('customers.update');
});

Route::prefix('flowers')->group(function(){
    Route::get('/', [FlowersController::class, 'index'])->name('flowers.index');
    Route::get('/create', [FlowersController::class, 'create'])->name('flowers.create');
    Route::get('/update', [FlowersController::class, 'update'])->name('flowers.update');
});

Route::get('/transaction', function () {
    return view('transaction', ['flowers' => [
        [
            'name' => 'Sunflowers',
            'price' => '25000',
            'stock' => '250'
        ],
        [
            'name' => 'Red Roses',
            'price' => '10000',
            'stock' => '100'
        ],
        [
            'name' => 'White Roses',
            'price' => '15000',
            'stock' => '150'
        ],
        [
            'name' => 'Tulips',
            'price' => '20000',
            'stock' => '80'
        ]
    ]], ['customers' => [
        [
            'name' => 'Jais Adnan Saleh',
            'gender' => 'L',
            'phone' => '089145925180',
            'address' => 'Jalan Cilimus No.23'
        ],
        [
            'name' => 'Ine',
            'gender' => 'P',
            'phone' => '085610739621',
            'address' => 'Jalan Pesantren No.190'
        ],
        [
            'name' => 'Neni',
            'gender' => 'P',
            'phone' => '089681520340',
            'address' => 'Jalan Cililin No.04'
        ],
        [
            'name' => 'Evri',
            'gender' => 'P',
            'phone' => '087812379456',
            'address' => 'Jalan Cilimus No.1'
        ],
        [
            'name' => 'Zalfa',
            'gender' => 'L',
            'phone' => '087945321678',
            'address' => 'Jalan Cililin No.100'
        ],
        [
            'name' => 'Zacky',
            'gender' => 'L',
            'phone' => '088909876543',
            'address' => 'Jalan Raya No.201'
        ],
        [
            'name' => 'Meisya',
            'gender' => 'P',
            'phone' => '086712345678',
            'address' => 'Jalan Merdeka No.146'
        ],
        [
            'name' => 'Eknath',
            'gender' => 'L',
            'phone' => '081234567890',
            'address' => 'Jalan Merdeka No.90'
        ]
    ]]);
});

