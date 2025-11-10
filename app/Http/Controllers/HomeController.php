<?php

namespace App\Http\Controllers;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::withSum('orderItems', 'quantity')
            ->orderByDesc('order_items_sum_quantity')
            ->limit(4)
            ->get();

        $products = Product::orderBy('created_at', 'desc')
            ->limit(8)
            ->get();
            
        return view('customer.index', compact('featuredProducts', 'products'));
    }

    public function products()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(12);
        return view('customer.products', compact('products'));
    }

}
