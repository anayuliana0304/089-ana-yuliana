<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Flower;

class FlowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $flower = [
            [
                'name' => 'Rose Bouquet',
                'price' => '80000',
                'category_id' => '1',
                'stock' => '30',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lilies Bouquet',
                'price' => '80000',
                'category_id' => '1',
                'stock' => '40',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Orchid Arrangement',
                'price' => '200000',
                'category_id' => '2',
                'stock' => '50',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Birthday Arrangement',
                'price' => '250000',
                'category_id' => '2',
                'stock' => '30',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Basket Daisy',
                'price' => '200000',
                'category_id' => '3',
                'stock' => '20',
                'created_at' => now(),
                'updated_at' => now()
            ], 
            [
                'name' => 'White Daisy',
                'price' => '25000',
                'category_id' => '4',
                'stock' => '150',
                'created_at' => now(),
                'updated_at' => now()
            ],  
            [
                'name' => 'Red Tulips',
                'price' => '25000',
                'category_id' => '4',
                'stock' => '100',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Red Roses',
                'price' => '2000',
                'category_id' => '4',
                'stock' => '120',
                'created_at' => now(),
                'updated_at' => now()
            ]  
        ];

        Flower::insert($flower);
    }
}
