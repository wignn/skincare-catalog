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
                            <div class="flex items-center space-x-2">
                                {{-- Decrease --}}
                                <button wire:click="decreaseQuantity({{ $item->id }})"
                                    class="px-2 py-1 bg-gray-300 rounded">-
                                </button>

                                {{-- Quantity --}}
                                <span>{{ $item->quantity }}</span>

                                {{-- Increase --}}
                                <button wire:click="increaseQuantity({{ $item->id }})"
                                    class="px-2 py-1 bg-gray-300 rounded">+</button>
                            </div>
                        </td>
                        <td class="p-2">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                        <td class="p-2">
                            <button wire:click="removeItem({{ $item->id }})" class="text-red-500 hover:underline">Delete</button>
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
        <p class="text-gray-500 text-center">Keranjang Kosong</p>
    @endif
</div>