<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = [
            [
                'name' => 'Eknath',
                'gender' => 'L',
                'phone' => '086723560976',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Zacky',
                'gender' => 'L',
                'phone' => '088906431679',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Nindy',
                'gender' => 'P',
                'phone' => '085678904326',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Customer::insert($customer);
    }
}
