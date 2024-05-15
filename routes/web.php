<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/customers', function () {
    return view('customers', ['customers' => [
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

Route::get('/flowers', function () {
    return view('flowers', ['flowers' => [
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
    ]]);
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

Route::get('/users', function () {
    return view('users', ['users' => [
        [
            'username' => 'admin',
            'name' => 'Ana Yuliana',
            'password' => '*********',
            'level' => 'admin'
        ],
        [
            'username' => 'kasir1',
            'name' => 'Kaluna',
            'password' => '*********',
            'level' => 'kasir'
        ],
        [
            'username' => 'kasir2',
            'name' => 'Karissa',
            'password' => '*********',
            'level' => 'kasir'
        ]
    ]]);
});
