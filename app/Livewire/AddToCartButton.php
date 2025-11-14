<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class AddToCartButton extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to add items to the cart.');
            return redirect()->route('login');
        }

        $userId = Auth::id();

        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        $cartItem = $cart->items()->where('product_id', $this->product->id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $this->product->id,
                'quantity' => 1,
            ]);
        }

        $cartItem?->save();

        $this->dispatch('cartUpdated');
        // session()->flash('success', "{$this->product->name} added to cart!");
        $this->dispatch('toast', message:'Produk berhasil ditambahkan ke keranjang!');
    }
    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
