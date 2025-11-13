<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;


class CartComponent extends Component
{
    public $cart;
    public $items = [];
    public $total = 0;

    protected $listeners = ['updateTotal' => 'calculateTotal'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = Cart::where('user_id', Auth::id())->with('items.product')->first();

        if($this->cart) {
            $this->items = $this->cart->items;
            $this->calculateTotal();
        }
    }

    public function increaseQuantity($itemsId)
    {
        $item = CartItem::find($itemsId);
        $item->increment('quantity');
        $this->loadCart();
    }

    public function decreaseQuantity($itemsId)
    {
        $item = CartItem::find($itemsId);
        if ($item->quantity > 1) {
            $item->decrement('quantity');
        } else {
            $item->delete();
        }
        $this->loadCart();
    }

    public function removeItem($itemsId)
    {
        CartItem::find($itemsId)?->delete();
        $this->loadCart();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->items)->sum(fn($item) => $item->product->price * $item->quantity);
    }
    
    public function render()
    {
        return view('livewire.cart-component');
    }
}
