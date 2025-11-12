<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Skincare',
            'description' => 'Product from seeder',
            'price' => '20000',
            'stock' => '10',
        ]);

        Product::create([
            'name' => 'Makeup',
            'description' => 'Product from seeder',
            'price' => '30000',
            'stock' => '15',
        ]);

        Product::create([
            'name' => 'Fragrance',
            'description' => 'Product from seeder',
            'price' => '50000',
            'stock' => '5',
        ]);

        Product::create([
            'name' => 'Haircare',
            'description' => 'Product from seeder',
            'price' => '25000',
            'stock' => '8',
        ]);

        Product::create([
            'name' => 'Bodycare',
            'description' => 'Product from seeder',
            'price' => '15000',
            'stock' => '12',
        ]);
    }
}
