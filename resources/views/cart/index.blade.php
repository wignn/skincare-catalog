@extends('customer.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h2 class="text-2xl font-semibold mb-6">Keranjang Belanja</h2>

    @if($cart && $cart->items->count())
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b p-2">Produk</th>
                    <th class="border-b p-2">Harga</th>
                    <th class="border-b p-2">Qty</th>
                    <th class="border-b p-2">Total</th>
                    <th class="border-b p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->items as $item)
                    <tr>
                        <td class="p-2">{{ $item->product->name }}</td>
                        <td class="p-2">Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                        <td class="p-2">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                class="flex items-center space-x-2">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                    class="w-16 border rounded p-1">
                                <button type="submit" class="text-blue-600 hover:underline">Update</button>
                            </form>
                        </td>
                        <td class="p-2">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                        <td class="p-2">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @php
            $total = $cart->items->sum(fn($item) => $item->product->price * $item->quantity);
        @endphp

        <div class="mt-6 text-right font-semibold text-lg">
            Total: Rp {{ number_format($total, 0, ',', '.') }}
        </div>

        <div class="mt-6 text-right">
            <a href="{{ route('orders.create-from-cart') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Checkout
            </a>
        </div>
    @else
        <p class="text-gray-500">Keranjang Kosong</p>
    @endif
</div>
@endsection