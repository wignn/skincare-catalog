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
            'image' => 'products/oNLi8btHjZujFjqRNUvXLRzvoEWe3tJ370C7rC6T.png'
        ]);

        Product::create([
            'name' => 'Makeup',
            'description' => 'Product from seeder',
            'price' => '30000',
            'stock' => '15',
            'image' => 'products/01K9P3A02DD1A3C9RJ6PGK6CD5.png'
        ]);

        Product::create([
            'name' => 'Fragrance',
            'description' => 'Product from seeder',
            'price' => '50000',
            'stock' => '5',
            'image' => 'products/464141342_122173269974178668_1930767886253204813_n.jpg'
        ]);

        Product::create([
            'name' => 'Haircare',
            'description' => 'Product from seeder',
            'price' => '25000',
            'stock' => '8',
            'image' => 'products/h.jpg'
        ]);

        Product::create([
            'name' => 'Bodycare',
            'description' => 'Product from seeder',
            'price' => '15000',
            'stock' => '12',
            'image' => 'products/1696235955818.jpg'
        ]);
    }
}
