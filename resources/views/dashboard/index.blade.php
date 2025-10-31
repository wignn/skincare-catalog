@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Featured Products</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($products as $product)
            <div class="border rounded-lg overflow-hidden shadow-sm">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gray-100 flex items-center justify-center text-gray-500">
                        No Image
                    </div>
                @endif
                <div class="p-4">
                    <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600 text-sm">{{ $product->description }}</p>
                    <p class="mt-2 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <div class="flex justify-between gap-2 mt-3">
                        <a href="{{ route('products.edit', $product->id) }}"
                            class="w-1/2 text-center border border-gray-400 text-gray-700 py-2 rounded hover:bg-gray-100">
                            Edit
                        </a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="w-1/2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
