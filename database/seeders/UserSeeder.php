<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Mint',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => 'admin123',
        ]);
        User::create([
            'name' => 'Cust',
            'email' => 'Customer@gmail.com',
            'role' => 'customer',
            'password' => 'customer123',
        ]);
    }
}
