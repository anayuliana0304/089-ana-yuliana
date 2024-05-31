<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = [
            'username' => 'admin',
            'name' => 'Ana',
            'password' => bcrypt('password'),
            'level' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ];

        $list_user = [
            [
                'username' => 'cashier1',
                'name' => 'Kaluna',
                'password' => bcrypt('password'),
                'level' => 'cashier',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        User::insert($admin);
        User::insert($list_user);
    }
}
