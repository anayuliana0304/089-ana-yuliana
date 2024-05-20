<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function index() {
        $customers = [
            [
                'id' => 1,
                'name' => 'Jais Adnan Saleh',
                'gender' => 'L',
                'phone' => '089145925180',
                'address' => 'Jalan Cilimus No.23'
            ],
            [
                'id' => 2,
                'name' => 'Ine',
                'gender' => 'P',
                'phone' => '085610739621',
                'address' => 'Jalan Pesantren No.190'
            ],
            [
                'id' => 3,
                'name' => 'Neni',
                'gender' => 'P',
                'phone' => '089681520340',
                'address' => 'Jalan Cililin No.04'
            ],
            [
                'id' => 4,
                'name' => 'Evri',
                'gender' => 'P',
                'phone' => '087812379456',
                'address' => 'Jalan Cilimus No.1'
            ],
            [
                'id' => 5,
                'name' => 'Zalfa',
                'gender' => 'L',
                'phone' => '087945321678',
                'address' => 'Jalan Cililin No.100'
            ],
            [
                'id' => 6,
                'name' => 'Zacky',
                'gender' => 'L',
                'phone' => '088909876543',
                'address' => 'Jalan Raya No.201'
            ],
            [
                'id' => 7,
                'name' => 'Meisya',
                'gender' => 'P',
                'phone' => '086712345678',
                'address' => 'Jalan Merdeka No.146'
            ],
            [
                'id' => 8,
                'name' => 'Eknath',
                'gender' => 'L',
                'phone' => '081234567890',
                'address' => 'Jalan Merdeka No.90'
            ]
        ];
        
        return view('customers.index', [
            'customers' => $customers
        ]);
    }

    public function create(){
        return view('customers.create');
    }

    public function store(Request $request){

    }

    public function edit($id)
    {

    }

    public function update(){
        return view('customers.update');
    }
}
