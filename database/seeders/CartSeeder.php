<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use App\Models\Product;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $this->command->warn('User not found in database');
            return;
        }

        $products = Product::inRandomOrder()->take(2)->get();
        if ($products->isEmpty()) {
            $this->command->warn('Product not found in database');
            return;
        }

        $cart = Cart::firstOrCreate(['user_id'=>$user->id]);

        foreach ($products as $product) {
            CartItem::updateOrCreate(
                ['cart_id' => $cart->id, 'product_id'=> $product->id],
                ['quantity' => rand(1, 3)]
            );
        }

        $this->command->info("Cart created for {$user->name}");
    }
}
