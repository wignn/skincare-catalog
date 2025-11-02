<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Product;

class ProductList extends Component
{
    public $search = '';

    public function render()
    {
        if ($this->search) {
            return view('livewire.product-list', [
                'products' => Product::where('name', 'LIKE', "%{$this->search}%")->get(),
            ]);            
        } else {
            $products = Product::all();
        }
        return view('livewire.product-list', [
            'products' => $products
        ]);
    }
}
