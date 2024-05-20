<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flower;

class FlowersController extends Controller
{
    public function index() {
        $flowers = [
            [
                'id' => 1,
                'name' => 'Sunflowers',
                'price' => '25000',
                'stock' => '250'
            ],
            [
                'id' => 2,
                'name' => 'Red Roses',
                'price' => '10000',
                'stock' => '100'
            ],
            [
                'id' => 3,
                'name' => 'White Roses',
                'price' => '15000',
                'stock' => '150'
            ],
            [
                'id' => 4,
                'name' => 'Tulips',
                'price' => '20000',
                'stock' => '80'
            ]
        ];
        
        return view('flowers.index', [
            'flowers' => $flowers
        ]);
    }

    public function create(){
        return view('flowers.create');
    }

    public function update(){
        return view('flowers.update');
    }
}
