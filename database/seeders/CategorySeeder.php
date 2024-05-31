<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $category = [
            [
                'name' => 'Bouquets',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Arrangements Flower',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Flower Baskets',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Single Stem Flowers',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Category::insert($category);
    }
}
